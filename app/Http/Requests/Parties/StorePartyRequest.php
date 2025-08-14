<?php

namespace App\Http\Requests\Parties;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StorePartyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;// Gate::allows('parties_store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"=> [
                "required",
                Rule::unique("parties"),
                "max:191"
            ],
            "mobile"=>"required|max:191",
            "manager_name"=>"required",
            "activity_cd"=>"required",
            "status_cd"=>"required",

        ];
    }
    public function attributes()
    {
        return [
            "name"=>"اسم المؤسسة",
            "address"=>"رقم هاتف للتواصل",
            "manager_name"=>"اسم مدير المؤسسة",
            "activity_cd"=>"نوع النشاط",
            "status_cd"=>"الحالة",
        ];
    }
}
