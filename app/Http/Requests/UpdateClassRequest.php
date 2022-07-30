<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRequest extends FormRequest
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
            'homeroom_teacher' => 'required|exists:teachers,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tên lớp',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'homeroom_teacher.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn giáo viên',
            'homeroom_teacher.exists' => '<i class="bi bi-exclamation-circle"></i> Giáo viên không tồn tại',
        ];
    }
    
}
