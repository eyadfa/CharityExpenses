<?php

namespace App\Http\Requests\Settings\Countries;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCountriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('countries_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"=> "required",
            "iso"=> ["required",
                "min:2",
                "max:2"
            ],
            "iso3"=> ["required",
                "min:3",
                "max:3"
            ],
            "phone_code"=> "required"
        ];
    }
}
