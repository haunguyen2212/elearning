<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopicRequest extends FormRequest
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
            'title' => 'required|max:100',
            'content' => 'required|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tiêu đề',
            'title.max' => '<i class="bi bi-exclamation-circle"></i> Tiêu đề tối đa 100 ký tự',
            'content.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập nội dung',
            'content.max' => '<i class="bi bi-exclamation-circle"></i> Nội dung tối đa 500 ký tự'
        ];
    }
}
