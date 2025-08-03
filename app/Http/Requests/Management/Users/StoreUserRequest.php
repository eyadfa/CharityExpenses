<?php

namespace App\Http\Requests\Management\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('users_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "email"=> "required|unique:users",
            "related_emp_id"=> [
                "required",
                Rule::unique("users"),
                "min:3"
            ],
            "password"=>"required|string|min:8",
            "repassword"=>"required|string|min:8|same:password",
            "name"=> "required|string|min:3",
            "file"=> [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
        ];
    }
    public function attributes()
    {
        return [
            "email"=> "اسم المستخدم",
            "related_emp_id"=> "الموظف",
            "password"=>"كلمة المرور",
            "name"=> "الاسم",
            "file"=> "الصورة",
        ];
    }
}
