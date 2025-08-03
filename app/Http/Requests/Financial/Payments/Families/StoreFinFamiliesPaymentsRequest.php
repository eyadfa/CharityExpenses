<?php

namespace App\Http\Requests\Financial\Payments\Families;

use App\Rules\AtLeastOneGreaterThanZero;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreFinFamiliesPaymentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_pay_ben_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $payment_round_month = $this->payment_round_month;
        return [
            'payment_nature_cd' => 'required',
            'payment_value' => 'required|numeric',
            'payment_currency_cd' => 'required',
            'payment_round_year' => [
                'required',
                'integer',
                'between:' . (now()->year - 1) . ',' . (now()->year+1),
                Rule::unique('fin_families')->where(function ($query) use ($payment_round_month) {
                    return $query->where('payment_round_month', $payment_round_month);
                }),
            ],
            'payment_round_month' => 'required|integer|between:1,12',
            'payment_date' => [
                'required',
                'date',
                'after_or_equal:' . now()->startOfYear()->format('Y-m-d'),
                'before_or_equal:' . now()->endOfYear()->format('Y-m-d')
            ],
            'in_martyrs' => ['required', new AtLeastOneGreaterThanZero()],
            'in_wounded' => 'required',
            'in_prisoners' => 'required',
        ];
    }

}
