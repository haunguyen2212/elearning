<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolYearRequest extends FormRequest
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
            'name' => 'required|max:50',
            'start_time' => 'required|date_format:d-m-Y',
            'end_time' => 'required|date_format:d-m-Y|after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tên năm học',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Tên năm học không quá 50 kí tự',
            'start_time.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn ngày bắt đầu',
            'start_time.date_format' => '<i class="bi bi-exclamation-circle"></i> Ngày không đúng định dạng',
            'end_time.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập ngày kết thúc',
            'end_time.date_format' => '<i class="bi bi-exclamation-circle"></i> Ngày không đúng định dạng',
            'end_time.after' => '<i class="bi bi-exclamation-circle"></i> Thời gian kết thúc phải sau thời gian bắt đầu',
        ];
    }
}
