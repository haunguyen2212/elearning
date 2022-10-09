<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RenameTopicDocumentRequest extends FormRequest
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
            'name' => 'required|max:100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tên tài liệu',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Tên tối đa 100 ký tự',
        ];
    }
}
