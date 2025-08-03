<?php

namespace App\Http\Controllers\API\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Roles\StoreRolesManagementRequest;
use App\Http\Requests\Management\Roles\UpdateRolesManagementRequest;
use App\Models\Permission;
use App\Models\RolePermissions;
use App\Models\Role as Modelx;
use App\Models\UserRole;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{

    use ResponseTrait , SearchTrait;

    public function index(Request $request) {
        abort_if(Gate::denies('roles_search') , 403 , __("messages.permissions_denies"));
        $data = $request->all();
        $res = Modelx::orderBy("id" , "desc");
        if(!empty($data)){
            $fields["str"] =[ 'title' ];
            $res = $this->searching($res,$fields,$request);
        }
        return $this->customResponseData($res->get());
    }

    public function rolesM() {
        $res = Modelx::all();
        $arr = [];
        foreach($res as $r){
            $z = new \stdClass();
            $z->value = $r->id;
            $z->label = $r->title;
            $arr[]=$z;
        }
        return $this->customResponseData($arr);
    }

    public function store(StoreRolesManagementRequest $request) {
        $data = $request->all();
        $data["created_by"] = auth()->id();
        $perms = $data["perms"];
        unset($data["perms"]);

        $obj = Modelx::create($data);

        foreach($perms as $c){
            foreach($c["pages"] as $p){
                foreach($p["permissions"] as  $m){
                    if($m["status"]){
                        RolePermissions::create(["role_id"=>$obj->id,"permission_id"=> $m["id"]]);
                    }
                }
            }

        }
        return $this->customResponse(__('messages.insert'));
    }

    public function show($id) {
        $obj = Modelx::find($id);
        $perms = RolePermissions::where("role_id" , $id)->get()->pluck("permission_id")->toArray();
        $res = Permission::with(["controller", "page"])->select(["id","title","caption","controller_id" ,"page_id"])
            ->orderBy("controller_id","asc")->orderBy("page_id" , "asc")->get();
        $arr = [];
        foreach($res as $r){
            $arr[$r->controller_id]["title"]=$r->controller->name;
            $arr[$r->controller_id]["pages"][$r->page_id]["title"]=$r->page->name;
            $arr[$r->controller_id]["pages"][$r->page_id]["permissions"][]=[
                "id"=> $r->id,
                "title"=> $r->title ,
                "caption"=> $r->caption,
                "status"=>in_array($r->id , $perms)
            ];
        }$obj->permissions = $arr;
        return response()->json($obj);
    }

    public function update($id, UpdateRolesManagementRequest $request) {
        $obj = Modelx::find($id);
        $obj->update($request->all());

        $perms = $request->perms;
        RolePermissions::where("role_id" , $id)->delete();
        foreach($perms as $c){
            foreach($c["pages"] as $p){
                foreach($p["permissions"] as  $m){
                    if($m["status"]){
                        RolePermissions::create(["role_id"=>$id,"permission_id"=> $m["id"]]);
                    }
                }
            }

        }
        return $this->customResponse(__('messages.update'));
    }

    public function destroy($id) {
        abort_if(Gate::denies('roles_delete') , 403 , __("messages.permissions_denies"));
        $cnt = UserRole::where("role_id" , $id)->count();
        if($cnt > 0 ){
            return $this->customResponse(__("messages.delete_role_failure") ,200,false);
        }
        $obj = Modelx::find($id);
        $obj->delete();
        return $this->customResponse(__('messages.delete'));
    }

}
