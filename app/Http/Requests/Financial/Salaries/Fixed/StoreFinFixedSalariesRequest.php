<?php

namespace App\Http\Requests\Financial\Salaries\Fixed;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreFinFixedSalariesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_salaries_fixed_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|digits:4|between:2020,2025',
            'job_type_bonus.*' => 'nullable|numeric|min:0',
            'wife_bonus.*' => 'nullable|numeric|min:0',
            'sons_bonus.*' => 'nullable|numeric|min:0',
            'specialization_bonus.*' => 'nullable|numeric|min:0',
            'administrative_bonus.*' => 'nullable|numeric|min:0',
            'loan.*' => 'nullable|numeric|min:0',
            'deduction.*' => 'nullable|numeric|min:0',
            'discount.*' => 'nullable|numeric|min:0',
            'bonus.*' => 'nullable|numeric|min:0',
            'notes.*' => 'nullable|string|max:255',
        ];
    }

}
