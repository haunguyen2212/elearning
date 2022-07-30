<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeHomeroomTeacherRequest extends FormRequest
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
            'homeroom_teacher' => 'required|exists:teachers,id',
        ];
    }

    public function messages()
    {
        return [
            'homeroom_teacher.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn giáo viên',
            'homeroom_teacher.exists' => '<i class="bi bi-exclamation-circle"></i> Giáo viên không tồn tại',
        ];
    }
}
