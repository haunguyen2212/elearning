<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
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
            'code' => [
                'required',
                'max:10',
                Rule::unique('courses')->ignore($this->course),
            ],
            'name' => 'required|max:100',
            'teacher_id' => 'required|exists:teachers,id',
            'is_enrol' => 'required|in:0,1',
            'introduce' => 'nullable|max:500',
            'is_show' => 'required|in:0,1',
            'subject_id' => 'required|exists:subjects,id',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập mã khóa học',
            'code.unique' => '<i class="bi bi-exclamation-circle"></i> Mã khóa học đã tồn tại',
            'code.max' => '<i class="bi bi-exclamation-circle"></i> Mã khóa học tối đa 10 ký tự',
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tên khóa học',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn (100)',
            'teacher_id.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn giáo viên',
            'teacher_id.exists' => '<i class="bi bi-exclamation-circle"></i> Giáo viên không tồn tại',
            'is_enrol.required' => '<i class="bi bi-exclamation-circle"></i> Vui lòng chọn 1 giá trị',
            'is_enrol.in' => '<i class="bi bi-exclamation-circle"></i> Giá trị không hợp lệ',
            'introduce.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn (1000)',
            'is_show.required' => '<i class="bi bi-exclamation-circle"></i> Vui lòng chọn 1 giá trị',
            'is_show.in' => '<i class="bi bi-exclamation-circle"></i> Giá trị không hợp lệ',
            'subject_id.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn môn học',
            'subject_id.exists' => '<i class="bi bi-exclamation-circle"></i> Môn học không tồn tại',
        ];
    }
}
