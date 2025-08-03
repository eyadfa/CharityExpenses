<?php

namespace App\Http\Requests\Management\Departments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreDepartmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('departments_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name_ar"=>[
                "required",
                Rule::unique("departments_tb"),
                "min:2"
            ],
            "name_en"=>[
                "required",
                Rule::unique("departments_tb"),
                "min:2"
            ],
            "address"=>"required",
            "phone"=>"required|numeric|min:6",
            "country_id"=>"required",
            "city_id"=>"required",
            "description"=>"required",

        ];
    }
}
