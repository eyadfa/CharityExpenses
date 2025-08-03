<?php

namespace App\Http\Controllers\API\Settings;

use App\Exports\Settings\CodesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Codes\ActivateCodeRequest;
use App\Http\Requests\Settings\Codes\StoreCodeRequest;
use App\Http\Requests\Settings\Codes\UpdateCodeRequest;
use App\Models\Code;
use App\Traits\ResponseTrait;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class CodesController extends Controller
{
    use ResponseTrait,SearchTrait;

    public function index(Request $request) {
        abort_if(Gate::denies('codes_search') , 403 , __("messages.permissions_denies"));
        $res = $this->search($request);
        $res = $res->paginate(100);
        return $this->customResponseDataPage($res);
    }


    public function store(StoreCodeRequest $request) {
        $data = $request->all();
        if(!isset($request->main_cd) || $request->main_cd<1){
            $data["main_cd"] = DB::table("codes_tb")->max('main_cd') +1;
            $data["sub_cd"] =0;
        }else{
            $data["sub_cd"] = DB::table("codes_tb")->where("main_cd" , $request->main_cd)->max("sub_cd") +1;
        }
        $data["created_by"] = auth()->id();
        $data["updated_by"] = auth()->id();

        Code::create($data);
        return $this->customResponse(__('messages.insert'));
    }

    public function edit($id) {
        $code = Code::find($id);
        return response()->json($code);
    }

    public function update($id, UpdateCodeRequest $request) {
        $code = Code::find($id);
        $data = $request->all();
        unset($data["parent"]);
        $code->update($data);

        return $this->customResponse(__('messages.update'));
    }

    public function activation(ActivateCodeRequest $request){
        $obj =  Code::find($request->id);
        $data["updated_by"] = auth()->id();
        $data["is_active"] = intval($request->is_active);
        $obj->update($data);
        return $this->customResponse(__($request->is_active?'messages.activate':"messages.deactivate"));
    }

    public function getMainCodes (){
        $codes = Code::where('is_active',1)->where('sub_cd' , 0 )->get();
        return $this->customResponseData($codes);
    }

    public function getSubCodes($main_cds){
        $_cds = explode('_',$main_cds);
        $data=[];
        foreach($_cds as $c) {
            $codes = Code::where('is_active', 1)->where('sub_cd', '<>', 0)
                ->where('main_cd', $c)->orderBy('sub_cd', 'desc')->get();
            $data["_" . $c] = $codes;
        }
        return $this->customResponseData($data);
    }

    public function getAllActiveCodes(){
        $codes = Code::select("id","main_cd" , "sub_cd" , "desc_ar")
            ->where('is_active', 1)->where('sub_cd', '<>', 0)
            ->orderBy('main_cd')->orderBy('sub_cd')->get();
        $data=[];
        foreach($codes as $c){
            $data["_". $c->main_cd][]=$c;
        }
        return $this->customResponseData($data);
    }

    private function search($request){
        $data = $request->all();
        $res =  Code::with(["parent" , "controller" , "page"])->orderBy("main_cd")->orderBy("sub_cd");

        if(!empty($data)){
            $fields["str"]=["desc_ar"];
            $fields["int"]=['controller_id','page_id','sub_cd' , "main_cd"  , "is_active"];
            $fields["date"]=[];
            $res = $this->searching($res,$fields,$request);
        }

        return $res;
    }
    public function export(Request $request)
    {
        abort_if(Gate::denies('codes_export_to_excel') , 403 , __("messages.permissions_denies"));
        $res = $this->search($request)->get();
        return \Excel::download(new CodesExport($res), "aa.xlsx");
    }

}
