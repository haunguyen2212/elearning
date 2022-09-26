<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'capacity' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập tên phòng',
            'name.max' => '<i class="bi bi-exclamation-circle"></i> Tên phòng không quá 50 ký tự',
            'capacity.required' => '<i class="bi bi-exclamation-circle"></i> Chưa nhập sức chứa phòng',
            'capacity.numeric' => '<i class="bi bi-exclamation-circle"></i> Giá trị không hợp lệ',
        ];
    }

}
