<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CateRequests extends FormRequest
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
            'name' => 'required|unique:category,name_category',
            'mota' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute bắt buộc nhập',
            'name.unique' => ':attribute đã tồn tại',
            'mota.required' => ':attribute bắt buộc nhập'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
            'mota' => 'Mô tả',

        ];
    }
}
