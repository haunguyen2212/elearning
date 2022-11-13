<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordStudentRequest extends FormRequest
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
            'current_password' => 'required|min:8|max:20|current_password:student',
            'new_password' => 'required|min:8|max:20|different:current_password',
            'confirm_password' => 'required_with:new_password|same:new_password',
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập mật khẩu hiện tại',
            'current_password.min' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu ít nhất 8 ký tự',
            'current_password.max' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu tối đa 20 ký tự',
            'current_password.current_password' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu không chính xác',
            'new_password.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập mật khẩu mới',
            'new_password.min' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu ít nhất 8 ký tự',
            'new_password.different' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập 1 mật khẩu mới',
            'new_password.max' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu tối đa 20 ký tự',
            'confirm_password.required_with' => '<i class="bi bi-exclamation-circle"></i> Chưa xác nhận lại mật khẩu',
            'confirm_password.same' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu không trùng khớp',
        ];
    }
}
