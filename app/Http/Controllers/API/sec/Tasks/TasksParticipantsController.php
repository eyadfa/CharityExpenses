<?php

namespace App\Http\Controllers\API\sec\Tasks;

use App\Exports\TasksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Secretarial\Tasks\StoreTaskTeamRequest;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskNotes;
use App\Models\TaskParticipants;
use App\Traits\FileUploadTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TasksParticipantsController extends Controller
{
    use ResponseTrait,FileUploadTrait;

    public function index($id , Request $request)
    {
        $res = TaskParticipants::where("task_id" , $id)->get();
        return $this->customResponseData($res);
    }

    public function store($id,StoreTaskTeamRequest $request){
        $c = $request->all();
        TaskParticipants::create([
            "task_id" =>$id,
            "is_internal" => $c['is_internal'],
            "participant_id" => $c['participant_id'],
            "participant_name" => $c['participant_name'],
            "created_by" => auth()->id()
        ]);
        $obj = TaskParticipants::where( "task_id" , $id)->get();
        return $this->customResponseData($obj);
    }



}
