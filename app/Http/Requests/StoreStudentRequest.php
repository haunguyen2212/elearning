<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'username' => 'required|min:5|max:20|unique:students,username',
            'name' => 'required|max:50',
            'date_of_birth' => 'required|date_format:d-m-Y',
            'gender' => 'required|in:0,1',
            'place_of_birth' => 'required|max:200',
            'class' => 'required|exists:classes,id',
            'address' => 'nullable|max:200',
            'phone' => 'nullable|max:10|unique:students,phone',
            'email' => 'nullable|max:100|email|unique:students,email',
            'password' => 'required|min:8|max:20',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tên tài khoản',
            'username.min' => '<i class="bi bi-exclamation-circle"></i> Tên tài khoản ít nhất 5 ký tự',
            'username.max' => '<i class="bi bi-exclamation-circle"></i> Tên tài khoản không quá 20 ký tự',
            'username.unique' => '<i class="bi bi-exclamation-circle"></i> Tên tài khoản đã tồn tại',
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập họ và tên',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'date_of_birth.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập ngày sinh',
            'date_of_birth.date_format' => '<i class="bi bi-exclamation-circle"></i> Ngày sinh chưa đúng định dạng (d-m-Y)',
            'gender.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn giới tính',
            'gender.in' => '<i class="bi bi-exclamation-circle"></i> Giá trị không hợp lệ',
            'place_of_birth.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập nơi sinh',
            'place_of_birth.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'class.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn lớp học',
            'class.exists' => '<i class="bi bi-exclamation-circle"></i> Lớp học không tồn tại',
            'address.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'phone.max' => '<i class="bi bi-exclamation-circle"></i> Số điện thoại không hợp lệ',
            'phone.unique' => '<i class="bi bi-exclamation-circle"></i> Số điện thoại đã tồn tại',
            'email.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'email.email' => '<i class="bi bi-exclamation-circle"></i> Email không hợp lệ',
            'email.unique' => '<i class="bi bi-exclamation-circle"></i> Email đã tồn tại',
            'password.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập mật khẩu',
            'password.min' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu ít nhất 8 ký tự',
            'password.max' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu tối đa 20 ký tự',
        ];
    }
}
