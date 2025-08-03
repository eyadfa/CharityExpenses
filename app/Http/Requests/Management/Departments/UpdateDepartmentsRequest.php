<?php

namespace App\Http\Requests\Management\Departments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateDepartmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('departments_edit');
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
            "name_ar"=> [
                "required",
                Rule::unique("departments_tb")->ignore($this->id),
                "min:2"
            ],
            "name_en"=>[
                "required",
                Rule::unique("departments_tb")->ignore($this->id),
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
