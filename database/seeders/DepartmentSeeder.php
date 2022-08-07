<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'name' => 'Tổ Toán Học',
            ],
            [
                'name' => 'Tổ Ngữ Văn',
            ],
            [
                'name' => 'Tổ Vật Lý',
            ],
            [
                'name' => 'Tổ Hóa Học',
            ],
            [
                'name' => 'Tổ Lịch Sử',
            ],
            [
                'name' => 'Tổ Địa Lý',
            ],
            [
                'name' => 'Tổ Sinh Học',
            ],
            [
                'name' => 'Tổ Ngoại Ngữ',
            ],
            [
                'name' => 'Tổ Thể Dục - Quốc Phòng',
            ],
            [
                'name' => 'Tổ Tin Học',
            ],
            [
                'name' => 'Tổ Văn Phòng',
            ]
        ]);
    }
}
