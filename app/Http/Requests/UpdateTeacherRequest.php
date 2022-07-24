<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
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
            'username' => [
                'required',
                'min:5',
                'max:20',
                Rule::unique('teachers')->ignore($this->teacher)
            ],
            'name' => 'required|max:50',
            'date_of_birth' => 'required|date_format:d-m-Y',
            'gender' => 'required|in:0,1',
            'department' => 'required|exists:departments,id',
            'address' => 'required|max:200',
            'phone' => [
                'required',
                'max:10',
                Rule::unique('teachers')->ignore($this->teacher)
            ],
            'email' => [
                'required',
                'max:100',
                'email',
                Rule::unique('teachers')->ignore($this->teacher)
            ],
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
            'department.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn đơn vị',
            'department.exists' => '<i class="bi bi-exclamation-circle"></i> Đơn vị không tồn tại',
            'address.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập địa chỉ',
            'address.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'phone.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập số điện thoại',
            'phone.max' => '<i class="bi bi-exclamation-circle"></i> Số điện thoại không hợp lệ',
            'phone.unique' => '<i class="bi bi-exclamation-circle"></i> Số điện thoại đã tồn tại',
            'email.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập email',
            'email.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'email.email' => '<i class="bi bi-exclamation-circle"></i> Email không hợp lệ',
            'email.unique' => '<i class="bi bi-exclamation-circle"></i> Email đã tồn tại',
        ];
    }
}
