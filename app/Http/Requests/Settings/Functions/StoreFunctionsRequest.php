<?php

namespace App\Http\Requests\Settings\Functions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreFunctionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('functions_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "controller_id"=>"required|gt:0",
            "name"=>[
                "required",
                Rule::unique("controllers_functions_tb")
            ]
        ];
    }
}
