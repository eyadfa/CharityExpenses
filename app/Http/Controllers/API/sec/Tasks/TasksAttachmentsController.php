<?php

namespace App\Http\Controllers\API\sec\Tasks;

use App\Exports\TasksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Secretarial\Tasks\StoreTaskAttachmentRequest;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskNotes;
use App\Models\TaskParticipants;
use App\Traits\FileUploadTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TasksAttachmentsController extends Controller
{
    use ResponseTrait,FileUploadTrait;

    public function index(Request $request)
    {
        $res = $this->search($request);
        return $this->customResponseData($res);
    }

    public function store($id,StoreTaskAttachmentRequest $request){
        $file_desc = $request->file_desc;
        if (isset($request->fileToUpload) && $request->fileToUpload !=null) {
            $f_obj = TaskAttachment::create([
                "task_id" => $id,
                "note" =>$file_desc,
                "created_by" => auth()->id()
            ]);
            $path = $this->upload($request->fileToUpload,"task/" . $id , $f_obj->id);
            $f_obj->path = $path;
            $f_obj->save();
        }
        $obj = TaskAttachment::with(["creator"])->where( "task_id" , $id)->get();
        return $this->customResponseData($obj);

    }

}
