<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Codes\ActivateCodeRequest;
use App\Http\Requests\Settings\Controllers\ActivateControllersRequest;
use App\Http\Requests\Settings\Controllers\StoreSettingsRequest;
use App\Http\Requests\Settings\Controllers\UpdateControllersRequest;
use App\Models\Code;
use App\Models\Controller as Modelx;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ControllersController extends Controller
{
    use ResponseTrait , SearchTrait;

    public function index(Request $request) {
        abort_if(Gate::denies('controllers_search') , 403 , __("messages.permissions_denies"));
        $res = $this->search($request);
        $res = $res->paginate(100);
        return $this->customResponseDataPage($res);
    }
    private function search($request){
        $data = $request->all();
        $res =  Modelx::with(["functions"]);
        if(!empty($data)){
            $fields["str"]=['name' , "caption" ];
            $fields["int"]=[ "is_active" ];
            $fields["date"]=[];
            $res = $this->searching($res,$fields,$request);
        }

        return $res;
    }

    public function edit($id) {
        $obj = Modelx::find($id);
        return response()->json($obj);
    }

    public function update($id, UpdateControllersRequest $request) {
        $obj = Modelx::find($id);
        $obj->update($request->all());

        return $this->customResponse(__('messages.update'));
    }

    public function activation(ActivateControllersRequest $request){
        $obj =  Modelx::find($request->id);
        $data["updated_by"] = auth()->id();
        $data["is_active"] = intval($request->is_active);
        $obj->update($data);
        return $this->customResponse(__($request->is_active?'messages.activate':"messages.deactivate"));
    }

    public function active() {
        $res = Modelx::where("is_active" , 1)->get();
        return $this->customResponseData($res);
    }


}
