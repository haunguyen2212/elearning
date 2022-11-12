<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionTeacherRequest extends FormRequest
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
            'question' => 'required|max:3000',
            'correct_answer' => 'required|in:1,2,3,4',
            'answer_a' => 'required|max:1000',
            'answer_b' => 'required|max:1000',
            'answer_c' => 'nullable|max:1000|required_with:answer_d',
            'answer_d' => 'nullable|max:1000',
            'explain' => 'max:3000',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
            'level' => 'required|in:1,2,3',
            'shared' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'question.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập câu hỏi',
            'question.max' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập không quá 3000 ký tự',
            'correct_answer.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn câu trả lời đúng',
            'correct_answer.in' => '<i class="bi bi-exclamation-circle"></i> Giá trị không hợp lệ',
            'answer_a.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập đáp án',
            'answer_a.max' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập không quá 1000 ký tự',
            'answer_b.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập đáp án',
            'answer_b.max' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập không quá 1000 ký tự',
            'answer_c.required_with' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập đáp án',
            'answer_c.max' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập không quá 1000 ký tự',
            'answer_d.max' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập không quá 1000 ký tự',
            'explain.max' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập không quá 3000 ký tự',
            'image.mimes' => '<i class="bi bi-exclamation-circle"></i> Vui lòng chọn 1 hình ảnh',
            'image.max' => '<i class="bi bi-exclamation-circle"></i> Kích thước ảnh không quá 2MB',
            'level.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn mức độ câu hỏi',
            'level.in' => '<i class="bi bi-exclamation-circle"></i> Giá trị không hợp lệ',
            'shared.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn mức độ câu hỏi',
            'shared.in' => '<i class="bi bi-exclamation-circle"></i> Giá trị không hợp lệ',
        ];
    }
}
