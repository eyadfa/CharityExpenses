<?php

namespace App\Http\Controllers\API\Management;

use App\Http\Controllers\Controller;
use App\Models\Notifications as Modelx;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    use SearchTrait, ResponseTrait;
    public function index(Request $request)
    {
        $data = $request->all();
        $res = Modelx::orderBy("id", "desc");
        if (!empty($data)) {
            $request->user_id= Auth::id();
            $fields["str"] = ['title', 'body'];
            $fields["int"] = ['user_id' , 'status'];
            $res = $this->searching($res,$fields,$request);
        }
        return $this->customResponseDataPage($res->paginate(100));
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();

        Modelx::create($data);
        return $this->customResponse(__('messages.insert'));
    }

    public function edit($id)
    {
        $obj = Modelx::find($id);
        return response()->json($obj);
    }


    public function seen(Request $request)
    {
        $obj = Modelx::find($request->id);
        $data["updated_at"]=now();
        $data["status"]=1;
        $obj->update($data);

        return $this->customResponse(__('messages.update'));
    }

}
