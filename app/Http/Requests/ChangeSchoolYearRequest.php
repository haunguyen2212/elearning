<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeSchoolYearRequest extends FormRequest
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
            'id' => 'required|exists:school_years,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn năm học',
            'id.exists' => '<i class="bi bi-exclamation-circle"></i> Năm học không tồn tại',
        ];
    }
}
