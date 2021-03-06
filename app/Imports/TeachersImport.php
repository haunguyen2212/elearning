<?php

namespace App\Imports;

use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TeachersImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        return new Teacher([
            "username" => $row['username'],
            "name" => $row['name'],
            "department_id" => $row['department_id'],
            "gender" => $row['gender'],
            "date_of_birth" => Date::excelToDateTimeObject($row['date_of_birth']),
            "address" => $row['address'],
            "phone" => $row['phone'],
            "email" => $row['email'],
            "password" => Hash::make($row['password']),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.username' => ['required', 'max:20', 'unique:teachers,username'],
            '*.name' => ['required', 'max:50'],
            '*.department_id' => ['required', 'exists:departments,id'],
            '*.gender' => ['required', 'in:0,1'],
            '*.date_of_birth' => ['required'],
            '*.address' => ['required', 'max:200'],
            '*.phone' => ['required', 'unique:teachers,phone'],
            '*.email' => ['required', 'unique:teachers,email'],
            '*.password' => ['required', 'min:8', 'max:20'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '*.username.required' => 'Chưa nhập tên tài khoản',
            '*.username.max' => 'Tài khoản không quá 20 ký tự',
            '*.username.unique' => 'Tài khoản đã tồn tại',
            '*.name.required' => 'Chưa nhập họ và tên',
            '*.name.max' => 'Họ và tên không quá 50 ký tự',
            '*department_id.required' => 'Chưa nhập ID đơn vị',
            '*department_id.exists' => 'ID đơn vị không tồn tại',
            '*.gender.required' => 'Chưa nhập giới tính',
            '*.gender.in' => 'Giới tính chỉ nhận 2 giá trị 0 và 1',
            '*.date_of_birth.required' => 'Chưa nhập ngày sinh',
            '*.address.required' => 'Chưa nhập địa chỉ',
            '*.address.max' => 'Địa chỉ không quá 200 ký tự',
            '*.phone.required' => 'Chưa nhập số điện thoại',
            '*.phone.unique' => 'Số điện thoại đã tồn tại',
            '*.email.unique' => 'Chưa nhập email',
            '*.email.unique' => 'Email đã tồn tại',
            '*.password.required' => 'Chưa nhập mật khẩu',
            '*.password.min' => 'Mật khẩu ít nhất 8 ký tự',
            '*.password.max' => 'Mật khẩu tối đa 20 ký tự',
        ];
    }

    // public function onFailure(Failure ...$failures)
    // {
        
    // }

}
