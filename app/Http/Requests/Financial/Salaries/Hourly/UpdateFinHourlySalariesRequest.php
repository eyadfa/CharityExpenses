<?php

namespace App\Http\Requests\Financial\Salaries\Hourly;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateFinHourlySalariesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_salaries_hourly_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hour_no' => 'required|numeric|min:1',
            'hour_payments' => 'required|numeric|min:0.01',
            'currency_cd' => 'required',
            'notes' => 'required|string',
        ];
    }
}
