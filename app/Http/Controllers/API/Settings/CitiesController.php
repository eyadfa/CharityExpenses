<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Cities\ActivateCitiesRequest;
use App\Http\Requests\Settings\Cities\StoreCitiesRequest;
use App\Http\Requests\Settings\Cities\UpdateCitiesRequest;
use App\Models\City;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class CitiesController extends Controller
{
    //

    use ResponseTrait,SearchTrait;

    public function index(Request $request) {
        abort_if(Gate::denies('cities_search') , 403 , __("messages.permissions_denies"));
        $res = $this->search($request);
        $res = $res->paginate(100);
        return $this->customResponseDataPage($res);
    }

    private function search($request){
        $data = $request->all();
        $res =  City::query();
        if(!empty($data)){
            $fields["str"]=["name"];
            $fields["int"]=['country_id' , "capital"  , "is_active"];
            $fields["date"]=[];
            $res = $this->searching($res,$fields,$request);
        }
        return $res;
    }
    public function activation(ActivateCitiesRequest $request){
        $obj =  City::find($request->id);
        $data["updated_by"] = auth()->id();
        $data["is_active"] = intval($request->is_active);
        $obj->update($data);
        return $this->customResponse(__($request->is_active?'messages.activate':"messages.deactivate"));
    }

    public function store(StoreCitiesRequest $request) {
        $data = $request->all();
        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();
        City::create($data);
        return $this->customResponse(__('messages.insert'));
    }

    public function show($id) {
        $city = City::find($id);
        return response()->json($city);
    }

    public function update($id, UpdateCitiesRequest $request) {
        $city = City::find($id);
        $data = $request->all();
        unset($data["country"]);
        $city->update($data);

        return $this->customResponse(__('messages.update'));
    }


}
