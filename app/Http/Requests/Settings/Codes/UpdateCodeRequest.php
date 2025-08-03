<?php

namespace App\Http\Requests\Settings\Codes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('codes_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id'); // Adjust this according to how you're passing the ID

        return [
            "id"=>"required",
            "controller_id"=>"required",
            "page_id"=>"required",
            "main_cd"=>"required",
            "desc_ar"=>[
                "required" ,
                "min:3",
                Rule::unique('codes_tb')
                    ->where('controller_id', $this->input('controller_id'))
                    ->where('page_id', $this->input('page_id'))
                    ->where('main_cd', $this->input('main_cd'))
                    ->ignore($id),
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
