<?php

namespace App\Http\Controllers\API\sec\Followup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Family\common\attachments\StoreFamAttachmentsRequest;
use App\Http\Requests\Secretarial\Followup\attachments\StoreFollowupAttachemntRequest;
use App\Models\FollowupAttachments;
use App\Traits\FileUploadTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class FollowupsAttachmentsController extends Controller
{
    use ResponseTrait,FileUploadTrait;

    public function index(Request $request)
    {
        $res = $this->search($request);
        return $this->customResponseData($res);
    }

    public function store($id,StoreFollowupAttachemntRequest $request){
        $file_desc = $request->file_desc;
        if (isset($request->fileToUpload) && $request->fileToUpload !=null) {
            $f_obj = FollowupAttachments::create([
                "followup_id" => $id,
                "note" =>$file_desc,
                "created_by" => auth()->id()
            ]);
            $path = $this->upload($request->fileToUpload,"followup/" . $id , $f_obj->id);
            $f_obj->path = $path;
            $f_obj->save();
        }
        $obj = FollowupAttachments::with(["creator"])->where( "followup_id" , $id)->get();
        return $this->customResponseData($obj);

    }

}
