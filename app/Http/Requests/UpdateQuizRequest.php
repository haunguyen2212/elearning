<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
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
            'name' => 'required|max:200',
            'duration' => 'required|integer|min:0',
            'start_time' => 'required|date_format:d-m-Y H:i',
            'end_time' => 'required|date_format:d-m-Y H:i|after:start_time',
            'password' => 'required|min:8',
            'maximum' => 'required|min:1|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tên bài thi',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Tên bài thi không quá 200 ký tự',
            'duration.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập thời gian làm bài',
            'duration.integer' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập 1 số nguyên',
            'duration.min' => '<i class="bi bi-exclamation-circle"></i> Thời gian phải lớn hơn 0',
            'start_time.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập thời gian mở đề',
            'start_time.date_format' => '<i class="bi bi-exclamation-circle"></i> Định dạng thời gian không hợp lệ',
            'end_time.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập thời gian đóng đề',
            'end_time.date_format' => '<i class="bi bi-exclamation-circle"></i> Định dạng thời gian không hợp lệ',
            'end_time.after' => '<i class="bi bi-exclamation-circle"></i> Thời gian đóng đề phải sau thời gian mở đề',
            'password.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập mật khẩu',
            'password.min' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu ít nhất 8 ký tự',
            'maximum.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập lượt thi tối đa',
            'maximum.min' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập số lớn hơn 0',
            'maximum.integer' => '<i class="bi bi-exclamation-circle"></i> Vui lòng nhập 1 số nguyên',
        ];
    }
}
