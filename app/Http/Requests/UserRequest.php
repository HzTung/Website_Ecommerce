<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname' => 'required|unique:tbl_users',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:tbl_users'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => ':attribute bắt buộc nhập',
            'fullname.unique' => ':attribute đã tồn tại',
            'email.required' => ':attribute bắt buộc phải nhập',
            'email.email' => ':attribute phải đúng định dạng',
            'email.unique' => ':attribute đã tồn tại',
            'password.required' => ':attribute bắt buộc phải nhập',
            'password.min' => ':attribute không được nhỏ hơn :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'fullname' => 'Tên người dùng',
            'email' => 'email',
            'password' => 'password'
        ];
    }
}
