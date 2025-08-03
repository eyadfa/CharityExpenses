<?php

namespace App\Http\Controllers\API\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Users\ActivateUserRequest;
use App\Http\Requests\Management\Users\ChangePasswordRequest;
use App\Http\Requests\Management\Users\SetUserPermissionsRequest;
use App\Http\Requests\Management\Users\StoreUserRequest;
use App\Http\Requests\Management\Users\UpdateUserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\UserPermission;
use App\Models\UserRole;
use App\Traits\FileUploadTrait;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use App\Models\User as Modelx;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    use ResponseTrait,SearchTrait,FileUploadTrait;

    public function index(Request $request) {
        abort_if(Gate::denies('users_search') , 403 , __("messages.permissions_denies"));
        $data = $request->all();

        $res = Modelx::orderBy("id" , "desc");
        if(!empty($data)){
            $fields["str"] =[ 'name' , "email" ,  "city_id" , "phone" ];
            $fields["int"]=[ "department_id" ,"has_login","is_active"];
            $res = $this->searching($res,$fields,$request);
        }

        return $this->customResponseDataPage($res->paginate(100));
    }

    public function managers(){
        $res = Modelx::where("user_position" , 2)->where("is_active" , 1)->get();
        return $this->customResponseData($res);

    }

    public function store(StoreUserRequest $request) {
        $data = $request->all();
        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();
        $data["is_active"]=intval($data["is_active"]);
        $data["password"] = Hash::make($request->password);
        $obj = Modelx::create($data);
        if (isset($request->file) && $request->file != "undefined") {
            $path = $this->upload($request->file, "management/users/" . $obj->id, "avatar");
            $obj->image_path = $path;
            $obj->save();
        }
        return $this->customResponse(__('messages.insert'));
    }

    public function show($id) {
        $obj = Modelx::find($id);
        $user_roles = UserRole::where("user_id" , $id)->get()->pluck("role_id")->toArray();
        $roles = Role::all();
        foreach ($roles as $r){
            $r->status= in_array($r->id , $user_roles);
        }

        $departments_controllers=[];
        // departments allowed permissions
//        $departments_controllers[0]=[2,3,4,5,7,8,12,13,15,16,18,19];
        $departments_controllers[1]=[4,5,6,7,8,9,10,11,12,13,14,15,16,18,19];
        $departments_controllers[2]=[4,5,7,8,12,13,15,16,17,18,19];
        $departments_controllers[3]=[5,7,8,12,13,15,16,18,19,20];
        $departments_controllers[4]=[5,7,8,12,13,15,16,18,19,22,25,26];
        $departments_controllers[5]=[5,7,8,12,13,15,16,18,19,23,25,26];
        $departments_controllers[6]=[5,7,8,12,13,15,16,18,19,24,25,26];
        $departments_controllers[7]=[5,6,7,8,9,10,11,12,13,15,16,18,19,27];
        $departments_controllers[8]=[5,7,8,12,13,15,16,18,19,28];
        $departments_controllers[9]=[5,7,8,12,13,15,16,18,19,29];
        $departments_controllers[10]=[5,7,8,12,13,15,16,18,19,30];
        $departments_controllers[11]=[5,7,8,12,13,15,16,18,19,31];
        $departments_controllers[12]=[5,7,8,12,13,15,16,18,19];

        $user_perms = UserPermission::where("user_id" , $id)->get()->pluck("permission_id")->toArray();
        $res = Permission::with(["controller", "page"])->select(["id","title","caption","controller_id" ,"page_id"])
            ->orderBy("controller_id","asc")->orderBy("page_id" , "asc");
        if($obj->department_id != 0){
            $perms="";
            if(isset($departments_controllers[$obj->department_id])){
                $perms =  $departments_controllers[$obj->department_id];
            }else{
                $perms = [5,7,8,12,13,15,16,18,19];
            }
            $res->whereIn("controller_id",$perms);
        }
        $res=$res->get();
        $arr = [];
        foreach($res as $r){
            $arr[$r->controller_id]["title"]=$r->controller->name;
            $arr[$r->controller_id]["pages"][$r->page_id]["title"]=$r->page->name;
            $arr[$r->controller_id]["pages"][$r->page_id]["permissions"][]=[
                "id"=> $r->id,
                "title"=> $r->title ,
                "caption"=> $r->caption,
                "status"=>in_array($r->id , $user_perms)
            ];
        }

        $obj->permissions = $arr;
        $obj->roles = $roles;
        return response()->json($obj);
    }

    public function update($id, UpdateUserRequest $request) {
        $obj = Modelx::find($id);
        $data = $request->all();
        $data["updated_by"] = auth()->id();
        $data["is_active"]=intval($data["is_active"]);
        unset($data["password"]);
        $obj->update($data);
        if (isset($request->file) && $request->file != "undefined") {
            $path = $this->upload($request->file, "management/users/" . $obj->id, "avatar");
            $obj->image_path = $path;
            $obj->save();
        }
        return $this->customResponse(__('messages.update'));
    }


    public function updatePermissions($id, SetUserPermissionsRequest $request) {

        UserPermission::where("user_id" , $id)->delete();
        if(isset($request->perms)){
            foreach($request->perms as $c){
                foreach($c["pages"] as $p){
                    foreach($p["permissions"] as  $m){
                        if($m["status"]){
                            UserPermission::create(["user_id"=>$id,"permission_id"=> $m["id"]]);
                        }
                    }
                }

            }
        }

        UserRole::where("user_id" , $id)->delete();
        if(isset($request->roles)){
            foreach ($request->roles as $v){
                if($v["status"]) {
                    UserRole::create(["user_id" => $id, "role_id" => $v["id"]]);
                }
            }
        }

        return $this->customResponse(__('messages.update'));
    }

    public function destroy($id) {
        abort_if(Gate::denies('users_delete') , 403 , __("messages.permissions_denies"));
        $obj = Modelx::find($id);
        $obj->delete();
        return $this->customResponse(__('messages.delete'));
    }


    public function changePassword(ChangePasswordRequest $request) {
        $c = Modelx::find($request->id);
        $c->password = Hash::make($request->password);
        $c->save();
        return $this->customResponse(__("messages.password_success"));
    }

    public function activation(ActivateUserRequest $request){
        $obj =  Modelx::find($request->id);
        $data["updated_by"] = auth()->id();
        $data["is_active"] = intval($request->is_active);
        $obj->update($data);
        return $this->customResponse(__($request->is_active?'messages.activate':"messages.deactivate"));
    }
}
