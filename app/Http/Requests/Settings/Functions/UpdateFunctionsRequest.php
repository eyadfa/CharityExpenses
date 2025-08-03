<?php

namespace App\Http\Requests\Settings\Functions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateFunctionsRequest extends FormRequest
{
    /**
     * @var mixed
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('functions_edit');
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
            "controller_id"=>"required|gt:0",
            "name"=>[
                "required",
                Rule::unique("controllers_functions_tb")
                    ->where("controller_id" , $this->controller_id)
                    ->ignore($this->id)
            ]
        ];
    }
}
