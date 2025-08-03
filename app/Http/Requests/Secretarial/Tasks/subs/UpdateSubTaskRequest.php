<?php

namespace App\Http\Requests\Secretarial\Tasks\subs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSubTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('tasks_edit_sub_tasks');
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
            "task_id"=> "required",
            "title"=> "required",
            "assigned_to"=> "required",
            "start_date"=> "required",
            "due_date"=> "required|after_or_equal:start_date"
        ];
    }
    public function attributes()
    {
        return [
            "start_date"=>"تاريخ البداية",
            "due_date"=>"تاريخ الاستحقاق"
        ];
    }
}
