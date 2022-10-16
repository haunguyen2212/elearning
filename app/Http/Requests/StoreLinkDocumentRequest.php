<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkDocumentRequest extends FormRequest
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
            'name' => 'required|max:100',
            'link' => 'required|max:1000|url',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tên liên kết',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Tên liên kết tối đa 100 ký tự',
            'link.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập liên kết',
            'link.max' => '<i class="bi bi-exclamation-circle"></i> Liên kết tối đa 1000 ký tự',
            'link.url' => '<i class="bi bi-exclamation-circle"></i> Liên kết không hợp lệ',
        ];
    }
}
