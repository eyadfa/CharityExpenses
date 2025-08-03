<?php

namespace App\Http\Requests\Financial\Salaries\Fixed;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateFinFixedSalariesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_salaries_fixed_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
           'id' => 'required',
           'job_type_bonus' => 'required|numeric|min:0',
           'wife_bonus' => 'required|numeric|min:0',
           'sons_bonus' => 'required|numeric|min:0',
           'specialization_bonus' => 'required|numeric|min:0',
           'administrative_bonus' => 'required|numeric|min:0',
           'loan_discount' => 'required|numeric|min:0',
           'deduction_discount' => 'required|numeric|min:0',
           'other_discounts' => 'required|numeric|min:0',
           'bonuses' => 'required|numeric|min:0',
        ];
    }

}
