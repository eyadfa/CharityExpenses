<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Countries\ActivateCountriesRequest;
use App\Http\Requests\Settings\Countries\StoreCountriesRequest;
use App\Http\Requests\Settings\Countries\UpdateCountriesRequest;
use App\Models\City;
use App\Models\Country;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CountryController extends Controller
{
    use ResponseTrait,SearchTrait;

    public function index(Request $request) {
        abort_if(Gate::denies('countries_search') , 403 , __("messages.permissions_denies"));
        $res = $this->search($request);
        $res = $res->paginate(100);
        return $this->customResponseDataPage($res);
    }

    public function store(StoreCountriesRequest $request) {
        $data = $request->all();
        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();
        Country::create($data);
        return $this->customResponse(__('messages.insert'));
    }

    public function show($id) {
        $country = Country::find($id);
        return response()->json($country);
    }

    public function update($id, UpdateCountriesRequest $request) {
        $country = Country::find($id);
        $country->update($request->all());

        return $this->customResponse(__('messages.update'));
    }

    public function destroy($id) {
        abort_if(Gate::denies('countries_delete') , 403 , __("messages.permissions_denies"));
        $cnt = City::where("country_id" , $id)->count();
        if($cnt>0){
            return $this->customResponse(__('messages.delete_country_failure'),200,false);
        }
        $country = Country::find($id);
        $country->delete();

        return $this->customResponse(__('messages.delete'));
    }
    public function active(){
        $res= Country::where('is_active',1)->get();
        return $this->customResponseData($res);
    }
    public function activation(ActivateCountriesRequest $request){
        $obj =  Country::find($request->id);
        $data["updated_by"] = auth()->id();
        $data["is_active"] = intval($request->is_active);
        $obj->update($data);
        return $this->customResponse(__($request->is_active?'messages.activate':"messages.deactivate"));
    }

    private function search($request){
        $data = $request->all();
        $res =  Country::query();
        if(!empty($data)){
            $fields["str"]=["name","nickname","iso","iso3","phone_code"];
            $fields["int"]=["is_active"];
            $fields["date"]=[];
            $res = $this->searching($res,$fields,$request);
        }
        return $res;
    }

}
