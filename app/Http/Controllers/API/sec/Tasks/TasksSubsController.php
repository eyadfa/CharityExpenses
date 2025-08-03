<?php

namespace App\Http\Controllers\API\sec\Tasks;

use App\Exports\TasksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Secretarial\Tasks\subs\FinishSubTaskRequest;
use App\Http\Requests\Secretarial\Tasks\subs\StoreSubTaskRequest;
use App\Http\Requests\Secretarial\Tasks\subs\UpdateSubTaskRequest;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskNotes;
use App\Models\TaskParticipants;
use App\Models\TaskSubs;
use App\Traits\FileUploadTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TasksSubsController extends Controller
{
    use ResponseTrait,FileUploadTrait;

    public function index(Request $request)
    {
        $res = $this->search($request);
        return $this->customResponseData($res);
    }


    public function edit($id)
    {
        $obj = TaskSubs::with(["participant"])->find($id);
        return $this->customResponseData($obj);
    }

    public function update($id, UpdateSubTaskRequest $request)
    {
        $obj = TaskSubs::find($id);
        $obj->update($request->all());
        return $this->customResponse(__('messages.update'));
    }

    public function finish(FinishSubTaskRequest $request)
    {
        $obj = TaskSubs::find($request->id);
        $obj->finished_at = date("Y-m-d H:i:s");
        $obj->finish_note = $request->finish_note;
        $obj->is_finished=1;
        $obj->finished_by= auth()->id();
        $obj->save();
        return $this->customResponse(__('messages.update'));
    }


    public function store(StoreSubTaskRequest $request){
        $data = $request->all();
        $data["created_by"] = auth()->id();
        TaskSubs::create($data);
        return $this->customResponse(__('messages.insert'));
    }




}
