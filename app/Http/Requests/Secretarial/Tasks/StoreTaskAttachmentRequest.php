<?php

namespace App\Http\Requests\Secretarial\Tasks;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreTaskAttachmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('tasks_add_attachemnts');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "file_desc"=>"required|string|max:190",
            "fileToUpload"=>"required|file|mimes:jpg,png,pdf,xls,xlsx,doc,docx,pdf|max:2048",
        ];
    }
    public function attributes()
    {
        return [
            "file_desc"=>"وصف المرفق",
            "fileToUpload"=>"المرفق",
        ];
    }
}
