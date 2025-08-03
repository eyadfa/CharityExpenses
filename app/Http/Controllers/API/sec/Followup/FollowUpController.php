<?php

namespace App\Http\Controllers\API\sec\Followup;

use App\Exports\FollowupsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Secretarial\Followup\FinishFollowupRequest;
use App\Http\Requests\Secretarial\Followup\ReplyFollowupRequest;
use App\Http\Requests\Secretarial\Followup\StoreFollowupRequest;
use App\Http\Requests\Secretarial\Followup\UpdateFollowupRequest;
use App\Models\FollowUp;
use App\Models\FollowupReply;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FollowUpController extends Controller
{
    use ResponseTrait, SearchTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('followup_search') , 403 , __("messages.permissions_denies"));
        $res = $this->search($request);
        $res = $res->paginate(100);
        return $this->customResponseDataPage($res);
    }

    private function search($request)
    {
        abort_if(Gate::denies('followup_search') , 403 , __("messages.permissions_denies"));
        $data = $request->all();
        $res = FollowUp::with(["follower","related","sourcex" , "creator"]);
        $user_emp_id = auth()->user()->related_emp_id;
        $res->where(function ($query) use ($user_emp_id) {
            $query->where("created_by", auth()->user()->id)
                ->orWhere("follower_id", $user_emp_id);
        });

        if (!empty($data)) {
            $fields["str"] = ["title", "commissioner", "details"];
            $fields["int"] = ["follower_id", "related_to", "commissioning_source_cd" , "is_finished"];
            $fields["date"] = ["due_date__from", "due_date__to" ,"finished_at__from","finished_at__to","created_at__from","created_at__to"];
            $res = $this->searching($res,$fields,$request);
        }
        return $res;
    }
    public function latest(){
        $res = FollowUp::with(["follower","related","sourcex" , "creator"]);
        $user_emp_id = auth()->user()->related_emp_id;
        $res->where("follower_id", $user_emp_id);

        $data = $res->latest()->take(10)->get();
        return $this->customResponseData($data);
    }

    public function store(StoreFollowupRequest $request)
    {
        $data = $request->all();

        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();
        $obj = FollowUp::create($data);
        return $this->customResponse(__('messages.insert'), 200, true, $obj);
    }

    public function show($id)
    {
        $obj = FollowUp::with(["attachments" ,"attachments.creator" ,"follower" , "replies", "replies.creator","related","sourcex" , "creator"])->find($id);
        return response()->json($obj);
    }

    public function addReply($id, ReplyFollowupRequest $request)
    {
        $data= [
            "followup_id" => $id,
            "created_by" => auth()->id(),
            "note" => $request->note
        ];
        FollowupReply::create($data);

        return $this->customResponse(__("messages.insert"));
    }

    public function finish($id, FinishFollowupRequest $request)
    {
        $obj = FollowUp::find($id);
        $data = $request->all();
        $obj->finished_at = date("Y-m-d H:i:s");
        $obj->finish_note = $request->note;
        $obj->is_finished=1;
        $obj->update($data);
        $obj->save();
        return $this->customResponse(__("messages.insert"));
    }

    public function export(Request $request)
    {
        abort_if(Gate::denies('followup_export_to_excel') , 403 , __("messages.permissions_denies"));
        $res = $this->search($request);
        return \Excel::download(new FollowupsExport($res->get()), "aa.xlsx");

    }
}
