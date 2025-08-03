<?php

namespace App\Http\Requests\Financial\Salaries\Contracts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateFinContractSalariesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_salaries_contract_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentYear = now()->year;

        return [
            'month' => 'required|integer|min:1|max:12',
            'loan_discount' => 'required|numeric|min:0',
            'deduction_discount' => 'required|numeric|min:0',
            'other_discounts' => 'required|numeric|min:0',
            'bonuses' => 'required|numeric|min:0',
            'notes' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'month.required' => 'حقل الشهر مطلوب.',
            'loan.required' => 'حقل قرض الموظف مطلوب.',
            'loan.numeric' => 'حقل قرض الموظف يجب أن يكون رقمًا.',
            'loan.min' => 'قيمة القرض يجب ألا تكون أقل من 0.',
            'deduction.required' => 'حقل الخصم مطلوب.',
            'deduction.numeric' => 'حقل الخصم يجب أن يكون رقمًا.',
            'deduction.min' => 'قيمة الخصم يجب ألا تكون أقل من 0.',
            'discount.required' => 'حقل الخصم الآخر مطلوب.',
            'discount.numeric' => 'حقل الخصم الآخر يجب أن يكون رقمًا.',
            'discount.min' => 'قيمة الخصم الآخر يجب ألا تكون أقل من 0.',
            'bonus.required' => 'حقل العلاوة مطلوب.',
            'bonus.numeric' => 'حقل العلاوة يجب أن يكون رقمًا.',
            'bonus.min' => 'قيمة العلاوة يجب ألا تكون أقل من 0.',
            'notes.required' => 'حقل الملاحظات مطلوب.',
            'notes.string' => 'حقل الملاحظات يجب أن يكون نصيًا.',
            'notes.max' => 'حقل الملاحظات يجب ألا يزيد عن 255 حرفًا.',
        ];
    }
}
