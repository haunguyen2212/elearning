<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileStudentRequest extends FormRequest
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
            'name' => 'required|max:50',
            'date_of_birth' => 'required|date_format:d-m-Y',
            'gender' => 'required|in:0,1',
            'place_of_birth' => 'required|max:200',
            'address' => 'nullable|max:200',
            'phone' => [
                'nullable',
                'max:10',
                Rule::unique('students')->ignore(auth()->guard('student')->id())
            ],
            'email' => [
                'nullable',
                'max:100',
                'email',
                Rule::unique('students')->ignore(auth()->guard('student')->id())
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập họ và tên',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'date_of_birth.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập ngày sinh',
            'date_of_birth.date_format' => '<i class="bi bi-exclamation-circle"></i> Ngày sinh chưa đúng định dạng (d-m-Y)',
            'gender.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn giới tính',
            'gender.in' => '<i class="bi bi-exclamation-circle"></i> Giá trị không hợp lệ',
            'place_of_birth.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập nơi sinh',
            'place_of_birth.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'address.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'phone.max' => '<i class="bi bi-exclamation-circle"></i> Số điện thoại không hợp lệ',
            'phone.unique' => '<i class="bi bi-exclamation-circle"></i> Số điện thoại đã tồn tại',
            'email.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'email.email' => '<i class="bi bi-exclamation-circle"></i> Email không hợp lệ',
            'email.unique' => '<i class="bi bi-exclamation-circle"></i> Email đã tồn tại',
        ];
    }
}
