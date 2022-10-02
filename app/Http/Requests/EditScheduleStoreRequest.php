<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditScheduleStoreRequest extends FormRequest
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
            'purpose' => 'required|max:100',
            'teacher_id' => 'required|exists:teachers,id',
            'amount' => 'required|numeric',
            'date' => 'required|date_format:d-m-Y|after_or_equal:'.date('Y-m-d'),
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_id' => 'required|exists:rooms,id',
        ];
    }

    public function messages()
    {
        return [
            'purpose.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập mục đích sử dụng phòng',
            'purpose.max' => '<i class="bi bi-exclamation-circle"></i> Số ký tự vượt quá giới hạn',
            'teacher_id.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn tên giáo viên',
            'teacher_id.exists' => '<i class="bi bi-exclamation-circle"></i> Giáo viên không tồn tại trên hệ thống',
            'amount.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập số lượng người tham gia',
            'amount.numeric' => '<i class="bi bi-exclamation-circle"></i> Giá trị không hợp lệ',
            'date.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn ngày đăng ký',
            'date.date_format' => '<i class="bi bi-exclamation-circle"></i> Ngày không đúng định dạng',
            'date.after_or_equal' => '<i class="bi bi-exclamation-circle"></i> Ngày đăng ký đã quá hạn',
            'start_time.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn thời gian bắt đầu',
            'start_time.date_format' => '<i class="bi bi-exclamation-circle"></i> Thời gian không đúng định dạng',
            'end_time.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn thời gian kết thúc',
            'end_time.after' => '<i class="bi bi-exclamation-circle"></i> Thời gian kết thúc phải sau thời gian bắt đầu',
            'end_time.date_format' => '<i class="bi bi-exclamation-circle"></i> Thời gian không đúng định dạng',
            'room_id.required' => '<i class="bi bi-exclamation-circle"></i> Chưa chọn phòng',
            'room_id.exists' => '<i class="bi bi-exclamation-circle"></i> Phòng không tồn tại',
        ];
    }
}
