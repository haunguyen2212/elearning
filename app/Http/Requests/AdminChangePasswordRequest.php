<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminChangePasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:8|max:20'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập mật khẩu',
            'password.min' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu ít nhất 8 ký tự',
            'password.max' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu tối đa 20 ký tự',
        ];
    }
}
