<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckLoginRequest extends FormRequest
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
            'username' => 'required|max:20',
            'password' => 'required|min:8|max:20',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tài khoản',
            'username.max' => '<i class="bi bi-exclamation-circle"></i> Tài khoản không hợp lệ',
            'password.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập mật khẩu',
            'password.min' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu không hợp lệ',
            'password.max' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu không hợp lệ',
        ];
    }
}
