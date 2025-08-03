<?php

namespace App\Http\Requests\Agenda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateAgendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('agenda_edit');
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
            "name"=>"required|max:191",
            "address"=>"required|max:191",
            "priority_cd"=>"required",
            "start_date"=>"required|date",
            "end_date"=>"required|date|after_or_equal:start_date",
            "details"=>"required",
        ];
    }
    public function attributes()
    {
        return [
            "name"=>"الموضوع",
            "address"=>"المكان",
            "priority_cd"=>"الأهمية",
            "start_date"=>"تاريخ البداية",
            "end_date"=>"تايخ النهاية",
            "details"=>"التفاصيل",
        ];
    }
}
