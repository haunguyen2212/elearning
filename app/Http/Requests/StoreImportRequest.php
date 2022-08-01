<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImportRequest extends FormRequest
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
            'file' => 'required|mimetypes:'.
                'application/vnd.ms-office,'.
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,'.
                'application/vnd.ms-excel',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn file',
            'file.mimetypes' => '<i class="bi bi-exclamation-circle"></i> Chỉ có thể chọn file excel',
        ];
    }
}
