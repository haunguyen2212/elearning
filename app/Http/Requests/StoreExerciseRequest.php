<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExerciseRequest extends FormRequest
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
            'content' => 'required|max:1000',
            'expiration_date' => 'required|date_format:d-m-Y H:i:s|after:now',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tiêu đề',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Tiêu đề không quá 200 ký tự',
            'content.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập nội dung',
            'content.max' => '<i class="bi bi-exclamation-circle"></i> Nội dung không quá 1000 ký tự',
            'expiration_date.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập ngày hết hạn',
            'expiration_date.date_format' => '<i class="bi bi-exclamation-circle"></i> Định dạng không hợp lệ',
            'expiration_date.after' => '<i class="bi bi-exclamation-circle"></i> Thời gian không hợp lệ',
        ];
    }
}
