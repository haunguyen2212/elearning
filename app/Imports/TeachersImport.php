<?php

namespace App\Imports;

use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TeachersImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable, SkipsErrors;

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
            '*.username' => ['required', 'unique:teachers,username'],
            '*.phone' => ['required', 'unique:teachers,phone'],
            '*.email' => ['required', 'unique:teachers,email'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '*.username.required' => 'Chưa nhập tên tài khoản',
            '*.username.unique' => 'Tài khoản đã tồn tại',
            '*.phone.required' => 'Chưa nhập số điện thoại',
            '*.phone.unique' => 'Số điện thoại đã tồn tại',
            '*.email.unique' => 'Chưa nhập email',
            '*.email.unique' => 'Email đã tồn tại',
        ];
    }

}
