<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('teachers')->insert([
            [
                'username' => 'TC0001',
                'name' => 'Nguyễn Thị Mỹ Linh',
                'department_id' => 1,
                'gender' => 1,
                'date_of_birth' => '1970-12-02',
                'address' => 'Long An',
                'phone' => '0771234567',
                'email' => 'linhntm@gmail.com',
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'TC0002',
                'name' => 'Nguyễn Thanh Huy',
                'department_id' => 1,
                'gender' => 0,
                'date_of_birth' => '1989-04-21',
                'address' => 'Cần Thơ',
                'phone' => '0791234567',
                'email' => 'huynt@gmail.com',
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'TC0003',
                'name' => 'Nguyễn Thành Long',
                'department_id' => 1,
                'gender' => 0,
                'date_of_birth' => '1995-01-12',
                'address' => 'Cần Thơ',
                'phone' => '0796434567',
                'email' => 'longnt@gmail.com',
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'TC0004',
                'name' => 'Lê Thị Thúy Vy',
                'department_id' => 1,
                'gender' => 1,
                'date_of_birth' => '1997-12-24',
                'address' => 'Cần Thơ',
                'phone' => '0796434209',
                'email' => 'vyltt@gmail.com',
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'TC0005',
                'name' => 'Nguyễn Duy Quang',
                'department_id' => 1,
                'gender' => 0,
                'date_of_birth' => '1986-04-20',
                'address' => 'Cần Thơ',
                'phone' => '0796434341',
                'email' => 'quangnd@gmail.com',
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'TC0006',
                'name' => 'Lâm Thị Kim Thi',
                'department_id' => 1,
                'gender' => 1,
                'date_of_birth' => '1978-07-30',
                'address' => 'Đồng Nai',
                'phone' => '0796434450',
                'email' => 'chiltk@gmail.com',
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
