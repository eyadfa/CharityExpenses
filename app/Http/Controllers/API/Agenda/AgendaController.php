<?php

namespace App\Http\Controllers\API\Agenda;

use App\Exports\Agenda\AgendaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Agenda\StoreAgendaRequest;
use App\Http\Requests\Agenda\UpdateAgendaRequest;
use App\Models\AgendaModel;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class AgendaController extends Controller
{
    use ResponseTrait , SearchTrait;
    public function index(Request $request) {
        abort_if(Gate::denies('agenda_search') ,403, __("messages.permissions_denies") );
        $res = $this->search($request);
        $res = $res->paginate(100);
        return $this->customResponseDataPage($res);
    }
    public function store(StoreAgendaRequest $request) {
        $data =$request->all();
        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();
        $data["employee_id"] = auth()->id();
        AgendaModel::create($data);
        return $this->customResponse(__('messages.insert'));
    }
    public function latest(){
        $res = AgendaModel::with(["priority"]);
        $res  =$res->where("employee_id" , auth()->id())
        ->whereDate('end_date', '>=', now()->toDateString());

        $data = $res->orderBy('start_date')->take(10)->get();
        return $this->customResponseData($data);
    }

    public function update($id, UpdateAgendaRequest $request) {
        $obj = AgendaModel::find($id);
        $data = $this->nulls($request->all());
        $data["updated_by"] = auth()->id();
        $obj->update($data);

        return $this->customResponse(__('messages.update'));
    }
    public function destroy($id) {
        abort_if(Gate::denies('agenda_delete') ,403, __("messages.permissions_denies") );
        $obj = AgendaModel::find($id);
        $obj->delete();
        return $this->customResponse(__('messages.delete'));
    }

    public function show($id) {
        $obj = AgendaModel::find($id);
        return response()->json($obj);
    }

    private function search($request){
        $data = $request->all();
        $res = AgendaModel::with(["priority"]);
        $res  =$res->where("employee_id" , auth()->id());
        if(!empty($data)){
            $fields["str"]=['name', 'address'];
            $fields["int"]=[];
            $fields["date"]=['start_date__from' , "start_date__to"];
            $res = $this->searching($res,$fields,$request);
        }

        return $res;
    }

    public function export(Request  $request){
        abort_if(Gate::denies('agenda_export_to_excel') ,403, __("messages.permissions_denies") );
        $res = $this->search($request)->get();
        return \Excel::download(new AgendaExport($res), "aa.xlsx");
    }


}
