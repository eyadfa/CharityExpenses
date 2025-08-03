<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Functions\ActivateFunctionsRequest;
use App\Http\Requests\Settings\Functions\StoreFunctionsRequest;
use App\Http\Requests\Settings\Functions\UpdateFunctionsRequest;
use App\Models\Code;
use App\Models\Functions as Modelx;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FunctionsController extends Controller
{
    use ResponseTrait, SearchTrait;

    public function index(Request $request) {
        abort_if(Gate::denies('functions_search') , 403 , __("messages.permissions_denies"));
        $res = $this->search($request);
        $resx = $res->paginate(100);
        return $this->customResponseDataPage($resx);
    }
    private function search($request){
        $data = $request->all();
        $res =  Modelx::with(["controller"]);
        if(!empty($data)){
            $fields["str"]=['name' , "caption" ];
            $fields["int"]=[ "is_active", "controller_id" ];
            $fields["date"]=[];
            $res = $this->searching($res,$fields,$request);
        }
        return $res;
    }


    public function store(StoreFunctionsRequest  $request) {
        $data = $request->all();
        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();
        Modelx::create($data);
        return $this->customResponse(__('messages.insert'));
    }

    public function show($id) {
        $obj = Modelx::find($id);
        return response()->json($obj);
    }

    public function update($id, UpdateFunctionsRequest $request) {
        $obj = Modelx::find($id);
        $obj->update($request->all());

        return $this->customResponse(__('messages.update'));
    }

    public function destroy($id) {
        abort_if(Gate::denies('functions_delete') , 403 , __("messages.permissions_denies"));
        $cnt = Code::where("page_id" , $id)->count();
        if($cnt>0){
            return $this->customResponse(__('messages.delete_page_failure'),200,false);
        }
        $obj = Modelx::find($id);
        $obj->delete();
        return $this->customResponse(__('messages.delete'));
    }
    public function activation(ActivateFunctionsRequest $request){
        $obj =  Modelx::find($request->id);
        $data["updated_by"] = auth()->id();
        $data["is_active"] = intval($request->is_active);
        $obj->update($data);
        return $this->customResponse(__($request->is_active?'messages.activate':"messages.deactivate"));
    }

}
