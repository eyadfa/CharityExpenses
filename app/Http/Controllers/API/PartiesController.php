<?php

namespace App\Http\Controllers\API;

use App\Exports\PartiesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parties\ActivatePartyRequest;
use App\Http\Requests\Parties\DestroyPartyRequest;
use App\Http\Requests\Parties\ExportToExcelPartyRequest;
use App\Http\Requests\Parties\SearchPartyRequest;
use App\Http\Requests\Parties\StorePartyRequest;
use App\Http\Requests\Parties\UpdatePartyRequest;
use App\Http\Resources\PartiesResource;
use App\Models\Parties  as Modelx;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;

class PartiesController extends Controller
{
    use ResponseTrait , SearchTrait;
    public function index(SearchPartyRequest $request) {
        $res = $this->search($request);
        $res = $res->paginate(100);
        return $this->customResponseDataPageWithResource($res , PartiesResource::class);
    }
    public function store(StorePartyRequest $request) {
        $data =$request->all();
        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();
        $data["employee_id"] = auth()->id();
        Modelx::create($data);
        return $this->customResponse(__('messages.insert'));
    }

    public function update($id, UpdatePartyRequest $request) {
        $obj = Modelx::find($id);
        $data = $this->nulls($request->all());
        $data["updated_by"] = auth()->id();
        $obj->update($data);

        return $this->customResponse(__('messages.update'));
    }
    public function destroy($id, DestroyPartyRequest $request) {
        $obj = Modelx::find($id);
        $obj->delete();
        return $this->customResponse(__('messages.delete'));
    }
    public function activation(ActivatePartyRequest $request){
        $obj =  Modelx::find($request->id);
        $data["updated_by"] = auth()->id();
        $data["status_cd"] = intval($request->status_cd);
        $obj->update($data);
        return $this->customResponse(__($request->is_active?'messages.activate':"messages.deactivate"));
    }
    public function show($id) {
        $obj = Modelx::find($id);
        return response()->json($obj);
    }

    private function search($request){
        $data = $request->all();
        $res = Modelx::with(["activity" , "status"]);
        if(!empty($data)){
            $fields["str"]=['name', 'manager_name' , 'mobile' ];
            $fields["int"]=['status_cd' , 'activity_cd'];
            $fields["date"]=[];
            $res = $this->searching($res,$fields,$request);
        }
        return $res;
    }

    public function export(ExportToExcelPartyRequest  $request){
        $res = $this->search($request)->get();
        return \Excel::download(new PartiesExport($res), "aa.xlsx");
    }

}
