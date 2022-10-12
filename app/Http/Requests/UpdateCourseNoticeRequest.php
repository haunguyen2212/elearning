<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseNoticeRequest extends FormRequest
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
            'notice' => 'max:3000',
        ];
    }

    public function messages()
    {
        return [
            'notice.max' => '<i class="bi bi-exclamation-circle"></i> Nhập tối đa 3000 ký tự',
        ];
    }
}
