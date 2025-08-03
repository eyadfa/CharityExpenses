<?php

namespace App\Http\Requests\Secretarial\Tasks\task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('tasks_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id"=> "required",
            "title"=> "required",
            "commissioner"=> "required",
            "commissioning_source_cd"=> "required",
            "start_date"=> "required",
            "due_date"=> "required|after:start_date",
            "details"=> "required",
            "priority_cd"=> "required",
        ];
    }

    public function attributes()
    {
        return [
            "start_date"=>"تاريخ البداية",
            "end_date"=>"تاريخ الاستحقاق"
        ];
    }
}
