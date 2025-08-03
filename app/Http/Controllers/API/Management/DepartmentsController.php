<?php

namespace App\Http\Controllers\API\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Departments\ActivateDepartmentsRequest;
use App\Http\Requests\Management\Departments\StoreDepartmentsRequest;
use App\Http\Requests\Management\Departments\UpdateDepartmentsRequest;
use App\Models\Department as Modelx;
use App\Models\Employee;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DepartmentsController extends Controller
{

    use ResponseTrait ,SearchTrait;
    public function index(Request $request) {
        $data = $request->all();
        $res = Modelx::orderBy("id" , "desc");
        if(!empty($data)){
            $fields["str"] =[ 'name_ar' , "name_en" , "country_id" , "city_id" , "phone" ];
            $fields["int"]=["is_active"];

            $res = $this->searching($res, $fields, $request);
        }
        return $this->customResponseDataPage($res->paginate(100));
    }

    public function store(StoreDepartmentsRequest $request) {
        $data = $request->all();
        $data["created_by"] = auth()->id();

        Modelx::create($data);
        return $this->customResponse("تمت الاضافة بنجاح");
    }

    public function show($id) {
        $obj = Modelx::find($id);
        return response()->json($obj);
    }

    public function update($id, UpdateDepartmentsRequest $request) {
        $obj = Modelx::find($id);
        $obj->update($request->all());

        return $this->customResponse("تم التعديل بنجاح");
    }

    public function destroy($id) {
        abort_if(Gate::denies('departments_delete') , 403 , __("messages.permissions_denies"));
        $cnt = Employee::where("department_id" , $id)->count();
        if($cnt >0){
            return $this->customResponse(__("messages.delete_department_failure"),200,false);
        }
        $obj = Modelx::find($id);
        $obj->delete();
        return $this->customResponse('تم الحذف بنجاح');
    }


    public function activation(ActivateDepartmentsRequest $request){
        $obj =  Modelx::find($request->id);
        $data["is_active"] = intval($request->is_active);
        $obj->update($data);
        return $this->customResponse(__($request->is_active?'messages.activate':"messages.deactivate"));
    }


}
