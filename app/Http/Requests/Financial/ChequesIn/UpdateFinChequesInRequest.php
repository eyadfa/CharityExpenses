<?php

namespace App\Http\Requests\Financial\ChequesIn;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateFinChequesInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('fin_cheques_in_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id= $this->id;
        return [
            "id"=> "required",
            "cheque_date"=> "required",
            "cheque_number"=> [
                "required" ,
                Rule::unique('codes_tb')
                    ->ignore($id),
            ],
            "amount"=> "required|numeric",
            "currency_cd"=> "required",
            "exchange_rate"=> "required|numeric",
            "bank_cd"=> "required",
            "doc"=>"nullable|file",
            "description"=> "required",
            "cheque_issuer"=> "required",
            "cheque_due_date"=> "required|after_or_equal:cheque_date",
        ];
    }
}
