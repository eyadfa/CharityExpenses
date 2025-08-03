<?php

namespace App\Http\Requests\Settings\Codes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('codes_store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "controller_id"=>"required",
            "page_id"=>"required",
            "main_cd"=>"required",
            "desc_ar"=>[
                "required" ,
                "min:3",
                Rule::unique('codes_tb')
                    ->where('controller_id', $this->input('controller_id'))
                    ->where('page_id', $this->input('page_id'))
                    ->where('main_cd', $this->input('main_cd')),
            ]
        ];
    }

    function attributes()
    {
        return [
            "desc_ar"=>"الوصف",
        ];
    }
}
