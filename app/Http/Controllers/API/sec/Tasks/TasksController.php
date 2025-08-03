<?php

namespace App\Http\Controllers\API\sec\Tasks;

use App\Exports\TasksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Secretarial\Tasks\StoreTaskReplyRequest;
use App\Http\Requests\Secretarial\Tasks\task\FinishTaskRequest;
use App\Http\Requests\Secretarial\Tasks\task\StoreTaskRequest;
use App\Http\Requests\Secretarial\Tasks\task\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskNotes;
use App\Models\TaskParticipants;
use App\Models\TaskSubs;
use App\Traits\FileUploadTrait;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TasksController extends Controller
{
    use ResponseTrait,FileUploadTrait,SearchTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tasks_search') ,403, __("messages.permissions_denies") );
        $res = $this->search($request);
        $res = $res->paginate(100);
        return $this->customResponseDataPage($res);
    }

    private function search($request)
    {
        $data = $request->all();
        $res = Task::with(["attachments" , "notes" ,"participants" , "sub_tasks", "priority" ,"source" ,"creator"]);
        $user_emp_id = auth()->user()->related_emp_id;
        $res->where(function ($query) use ($user_emp_id) {
            $query->where("created_by", auth()->user()->id)
                ->orWhereHas("participants", function ($q) use ($user_emp_id) {
                    $q->where("participant_id", $user_emp_id);
                });
        });


        if (!empty($data)) {
            $fields["str"] = ["title", "details", "commissioner", "caller_number"];
            $fields["int"] = ["commissioning_source_cd", "priority_cd", "is_finished"];
            $fields["date"]= ["start_date__from", "start_date__to", "due_date__from","due_date__to","finished_at__from","finished_at__to"];
            $res= $this->searching($res, $fields,$request);


        }
        return $res;
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->all();

        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();


        $obj = Task::create($data);
        $team = json_decode($data["team"] , true);
        foreach ($team as $c) {
            TaskParticipants::create([
                "task_id" =>$obj->id,
                "is_internal" => $c['is_internal'],
                "participant_id" => $c['participant_id'],
                "participant_name" => $c['participant_name'],
                "created_by" => auth()->id()
            ]);
        }

        $i =0;
        $file_desc = $request->file_desc;
       foreach ($request->fileToUpload as $c) {
            $f_obj = TaskAttachment::create([
                "task_id" => $obj->id,
                "note" =>$file_desc[$i++],
                "created_by" => auth()->id()
            ]);
            $path = $this->upload($c,"task/" . $obj->id , $f_obj->id);
            $f_obj->path = $path;
            $f_obj->save();
        }

        return $this->customResponse(__('messages.insert'), 200, true, $obj);
    }

    public function show($id)
    {
        $obj = Task::with(["attachments","attachments.creator" , "notes" ,"notes.creator","participants" ,
                            "sub_tasks", "priority" ,"source" ,"creator"])->find($id);

        $total = count($obj->sub_tasks);
        $finished = TaskSubs::where('task_id', $id)
            ->where('is_finished',1)
            ->count();
        $obj->progress = round( $total==0 ? 0 : $finished* 100 / $total , 2);
        return response()->json($obj);
    }

    public function update($id, UpdateTaskRequest $request)
    {
        $obj = Task::find($id);
        $data = $request->all();
        $data["updated_by"]= auth()->id();
        $obj->update($data);
        $obj->save();
        return $this->customResponse(__('messages.update'));
    }


    public function addReply($id,StoreTaskReplyRequest $request){
        $data= [
                "task_id" => $id,
                "created_by" => auth()->id(),
                "note" => $request->note
            ];
        TaskNotes::create($data);

        $obj = TaskNotes::with(["creator"])->where( "task_id" , $id)->get();
        return $this->customResponseData($obj);
    }


    public function finish($id, FinishTaskRequest $request)
    {
        $not_finished = TaskSubs::where('task_id', $id)
            ->where('is_finished',0)
            ->count();
        if($not_finished >0){
            return $this->customResponse(__("message.close_task_failure") ,200,false);
        }
        $obj = Task::find($id);
        $data = $request->all();
        $obj->finished_at = date("Y-m-d H:i:s");
        $obj->finish_note = $request->note;
        $obj->is_finished=1;
        $obj->finished_by=auth()->id();
        $obj->update($data);
        $obj->save();
        Task::find($id);
        return $this->customResponse(__("message.close_task_success"));
    }

    public function export(Request $request)
    {
        $res = $this->search($request);
        return \Excel::download(new TasksExport($res->get()), "aa.xlsx");

    }




}
