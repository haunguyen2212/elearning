<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoticeRequest extends FormRequest
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
            'name' => 'max:200',
            'link' => 'required|max:2048|mimes:pdf,doc,docx',
            'start_time' => 'required|date_format:d-m-Y H:i:s',
            'end_time' => 'required|date_format:d-m-Y H:i:s|after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn (200)',
            'link.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn file',
            'link.max' => '<i class="bi bi-exclamation-circle"></i> Kích thước file quá lớn',
            'link.mimes' => '<i class="bi bi-exclamation-circle"></i> Chỉ có thể chọn file doc, docx hoặc pdf',
            'start_time.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn thời gian bắt đầu',
            'start_time.date_format' => '<i class="bi bi-exclamation-circle"></i> Thời gian không đúng định dạng',
            'end_time.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn thời gian kết thúc',
            'end_time.date_format' => '<i class="bi bi-exclamation-circle"></i> Thời gian không đúng định dạng',
            'end_time.after' => '<i class="bi bi-exclamation-circle"></i> Thời gian kết thúc không hợp lệ',
        ];
    }
}
