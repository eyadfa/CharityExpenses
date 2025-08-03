<?php

namespace App\Http\Requests\Financial\Salaries\Contracts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreFinContractSalariesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_salaries_contract_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|between:' . date('Y') . ',' . date('Y'),
            'loan.*' => 'required|numeric|min:0',
            'deduction.*' => 'required|numeric|min:0',
            'discount.*' => 'required|numeric|min:0',
            'bonus.*' => 'required|numeric|min:0',
            'notes.*' => 'required|string',
        ];
    }
}
