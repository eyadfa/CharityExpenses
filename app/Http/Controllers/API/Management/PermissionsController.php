<?php

namespace App\Http\Controllers\API\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesRequests\Permissions\StorePermissionRequest;
use App\Http\Requests\EmployeesRequests\Permissions\UpdatePermissionRequest;
use App\Http\Requests\Management\Permissions\StorePermissionsManagementRequest;
use App\Http\Requests\Management\Permissions\UpdatePermissionsManagementRequest;
use App\Models\Permission as Modelx;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionsController extends Controller
{

    use ResponseTrait,SearchTrait;
    public function index(Request $request) {
        abort_if(Gate::denies('permissions_search') , 403 , __("messages.permissions_denies"));
        $data = $request->all();
        $res = Modelx::with(["controller", "page"]);
        if(!empty($data)){
            $fields["str"] =[ 'title' ];
            $fields["int"] =[ 'page_id' , "controller_id" ];
            $res = $this->searching($res,$fields,$request);
        }

        return $this->customResponseDataPage($res->paginate(100));
    }

    public function permsM() {

        $res = Modelx::with(["controller", "page"])->select(["id","title","caption","controller_id" ,"page_id"])
            ->orderBy("controller_id","asc")->orderBy("page_id" , "asc")->get();
        $arr = [];
        foreach($res as $r){
            $arr[$r->controller_id]["title"]=$r->controller->name;
            $arr[$r->controller_id]["pages"][$r->page_id]["title"]=$r->page->name;
            $arr[$r->controller_id]["pages"][$r->page_id]["permissions"][]=[
                "id"=> $r->id,
                "title"=> $r->title ,
                "caption"=> $r->caption,
                "status"=>false
                ];
        }
        return $this->customResponseData($arr);
    }

    public function store(StorePermissionsManagementRequest $request) {
        $data = $request->all();
        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();

        Modelx::create($data);
        $res = Modelx::where("page_id" , $request->page_id)->get();
        return $this->customResponse(__('messages.insert'),200,true, $res);
    }

    public function show($id) {
        $obj = Modelx::find($id);
        return response()->json($obj);
    }

    public function update($id, UpdatePermissionsManagementRequest $request) {
        $obj = Modelx::find($id);
        $obj->update($request->all());

        return $this->customResponse(__('messages.update'));
    }

}
