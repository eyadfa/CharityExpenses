<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Settings\ActivateSettingsRequest;
use App\Http\Requests\Settings\Settings\UpdateSettingsRequest;
use App\Models\SystemSettings;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SystemSettingsController extends Controller
{
    use ResponseTrait , SearchTrait;
    public function index(Request $request) {
        abort_if(Gate::denies('system_settings_search'),403, __("messages.permissions_denies"));
        $res = $this->search($request);
        $res = $res->paginate(100);
        return $this->customResponseDataPage($res);
    }

    public function update($id, UpdateSettingsRequest $request) {
        $obj =  SystemSettings::find($id);
        $data = $request->all();
        $data["updated_by"] = auth()->id();
        unset($data['key']); // key cannot be changed because it is used inside the js
        $obj->update($data);

        return $this->customResponse(__('messages.update'));
    }


    public function show($id) {
        $obj =  SystemSettings::find($id);
        return response()->json($obj);
    }

    private function search($request){
        $data = $request->all();
        $res =  SystemSettings::query();

        if(!empty($data)){
            $fields["str"]=["key", "notes"];
            $fields["int"]=["is_active"];
            $fields["date"]=[];
            $res = $this->searching($res,$fields,$request);
        }

        return $res;
    }
    public function activation(ActivateSettingsRequest $request){
        $obj =  SystemSettings::find($request->id);
        $data["updated_by"] = auth()->id();
        $data["is_active"] = intval($request->is_active);
        $obj->update($data);
        return $this->customResponse(__($request->is_active?'messages.activate':"messages.deactivate"));
    }

}
