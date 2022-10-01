<?php

namespace App\Imports;

use App\Models\Student;
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

class StudentsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{

    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        return new Student([
            "username" => $row['username'],
            "name" => $row['name'],
            "gender" => $row['gender'],
            "date_of_birth" => Date::excelToDateTimeObject($row['date_of_birth']),
            "place_of_birth" => $row['place_of_birth'],
            "address" => $row['address'],
            "phone" => $row['phone'],
            "email" => $row['email'],
            "password" => Hash::make($row['password']),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.username' => ['required', 'max:20', 'unique:students,username'],
            '*.name' => ['required', 'max:50'],
            '*.gender' => ['required', 'in:0,1'],
            '*.date_of_birth' => ['required'],
            '*.place_of_birth' => ['nullable', 'max:200'],
            '*.address' => ['nullable', 'max:200'],
            '*.phone' => ['nullable', 'max:10' ,'unique:students,phone'],
            '*.email' => ['nullable', 'email', 'max:100' ,'unique:students,email'],
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
            '*.gender.required' => 'Chưa nhập giới tính',
            '*.gender.in' => 'Giới tính chỉ nhận 2 giá trị 0 và 1',
            '*.date_of_birth.required' => 'Chưa nhập ngày sinh',
            '*.place_of_birth.max' => 'Nơi sinh không quá 200 ký tự',
            '*.address.max' => 'Địa chỉ không quá 200 ký tự',
            '*.phone.max' => 'Số điện thoại không quá 10 ký tự',
            '*.phone.unique' => 'Số điện thoại đã tồn tại',
            '*.email.email' => 'Email không đúng định dạng',
            '*.email.max' => 'Email tối đa 100 ký tự',
            '*.email.unique' => 'Email đã tồn tại',
            '*.password.required' => 'Chưa nhập mật khẩu',
            '*.password.min' => 'Mật khẩu ít nhất 8 ký tự',
            '*.password.max' => 'Mật khẩu tối đa 20 ký tự',
        ];
    }
}
