<?php

namespace App\Http\Requests\Financial\Salaries\Hourly;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreFinHourlySalariesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_salaries_hourly_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $employeeIds = request('employee_ids', []);

        $rules = [
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|digits:4',
        ];

        foreach ($employeeIds as $id) {
            $rules["hours.$id"] = 'required|numeric|min:1';
            $rules["rates.$id"] = 'required|numeric|min:0.01';
            $rules["currency_cd.$id"] = 'required|string';
            $rules["notes.$id"] = 'required|string';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'month.required' => 'شهر الصرف مطلوب.',
            'year.required' => 'سنة الصرف مطلوبة.',
            'hours.*.required' => 'عدد الساعات مطلوب.',
            'hours.*.numeric' => 'يجب أن تكون عدد الساعات رقمًا.',
            'rates.*.required' => 'سعر الساعة مطلوب.',
            'rates.*.numeric' => 'يجب أن يكون سعر الساعة رقمًا.',
            'currency_cd.*.required' => 'العملة مطلوبة.',
            'notes.*.required' => 'ملاحظات الموظف مطلوبة.',
        ];
    }
}
