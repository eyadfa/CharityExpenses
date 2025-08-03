<?php

namespace App\Http\Requests\Settings\Cities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreCitiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('cities_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "country_id" => "required",
            "name"=> [
                    "required",
                    "min:3",
                    Rule::unique("cities_tb")
                    ->where("country_id" , $this->country_id)
            ]
        ];
    }
}
