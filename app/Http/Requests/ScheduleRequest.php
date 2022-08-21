<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'from_date' => 'required|date_format:d-m-Y|after_or_equal:'.date('Y-m-d'),
            'to_date' => 'required|date_format:d-m-Y|after_or_equal:from_date',
        ];
    }

    public function messages()
    {
        return [
            'from_date.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn ngày bắt đầu',
            'from_date.date_format' => '<i class="bi bi-exclamation-circle"></i> Ngày không đúng định dạng',
            'from_date.after_or_equal' => '<i class="bi bi-exclamation-circle"></i> Ngày chọn đã quá hạn',
            'to_date.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn ngày kết thúc',
            'to_date.date_format' => '<i class="bi bi-exclamation-circle"></i> Ngày không đúng định dạng',
            'to_date.after_or_equal' => '<i class="bi bi-exclamation-circle"></i> Ngày đã chọn không hợp lệ',
        ];
    }
}
