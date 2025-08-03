<?php

namespace App\Http\Requests\Financial\Salaries\Hourly;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CertifyManagerFinHourlySalariesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_salaries_hourly_manager_certify');
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
            "notes"=>"nullable|string",
        ];
    }
}
