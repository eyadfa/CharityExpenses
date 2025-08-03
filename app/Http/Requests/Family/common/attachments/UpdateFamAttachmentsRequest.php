<?php

namespace App\Http\Requests\Family\common\attachments;

use App\Traits\HelperTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateFamAttachmentsRequest extends FormRequest
{
    use HelperTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows($this->getFamPermName("edit" ,"attachment" , $this->family_type_cd));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id"=>"required",
            "family_id"=>"required",
            "family_type_cd"=>"required",
            "title"=>"required",
            "request_date"=>"required|before:received_date",
            "received_date"=>"required",
            "issued_date"=>"required|before:received_date",
            "attachment_category_cd"=>"required",
            "request_reason"=>"required",
            "attachment_details"=>"required",
        ];
    }
    public function attributes()
    {
        return [
            'request_date'=>'تاريخ طلب المرفق',
            'received_date'=>'تاريخ استلام المرفق',
            'issued_date'=>'تاريخ اصدار المرفق',
            'doc'=>'المرفق',
        ];
    }
}
