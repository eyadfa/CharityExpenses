<?php

namespace App\Http\Requests\Financial\ChequesIn;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreFinChequesInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_cheques_in_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "cheque_date"=> "required",
            "cheque_number"=> "required|unique:fin_cheques_ins",
            "amount"=> "required|numeric",
            "currency_cd"=> "required",
            "exchange_rate"=> "required|numeric",
            "bank_cd"=> "required",
            "doc"=>"required|file",
            "description"=> "required",
            "cheque_issuer"=> "required",
            "cheque_due_date"=> "required|after_or_equal:cheque_date",
        ];
    }
}
