<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'name' => 'Toán 10',
            ],
            [
                'name' => 'Ngữ Văn 10',
            ],
            [
                'name' => 'Vật Lý 10',
            ],
            [
                'name' => 'Hóa học 10',
            ],
            [
                'name' => 'Lịch Sử 10',
            ],
            [
                'name' => 'Địa Lý 10',
            ],
            [
                'name' => 'Sinh Học 10',
            ],
            [
                'name' => 'Tiếng Anh 10',
            ],
            [
                'name' => 'Tin Học 10',
            ],
            [
                'name' => 'Thể Dục 10',
            ],
            [
                'name' => 'Quốc Phòng 10',
            ],
            [
                'name' => 'Giáo Dục Công Dân 10',
            ],
            [
                'name' => 'Công Nghệ 10',
            ],
            [
                'name' => 'Toán 11',
            ],
            [
                'name' => 'Ngữ Văn 11',
            ],
            [
                'name' => 'Vật Lý 11',
            ],
            [
                'name' => 'Hóa học 11',
            ],
            [
                'name' => 'Lịch Sử 11',
            ],
            [
                'name' => 'Địa Lý 11',
            ],
            [
                'name' => 'Sinh Học 11',
            ],
            [
                'name' => 'Tiếng Anh 11',
            ],
            [
                'name' => 'Tin Học 11',
            ],
            [
                'name' => 'Thể Dục 11',
            ],
            [
                'name' => 'Quốc Phòng 11',
            ],
            [
                'name' => 'Giáo Dục Công Dân 11',
            ],
            [
                'name' => 'Công Nghệ 11',
            ],
            [
                'name' => 'Toán 12',
            ],
            [
                'name' => 'Ngữ Văn 12',
            ],
            [
                'name' => 'Vật Lý 12',
            ],
            [
                'name' => 'Hóa học 12',
            ],
            [
                'name' => 'Lịch Sử 12',
            ],
            [
                'name' => 'Địa Lý 12',
            ],
            [
                'name' => 'Sinh Học 12',
            ],
            [
                'name' => 'Tiếng Anh 12',
            ],
            [
                'name' => 'Tin Học 12',
            ],
            [
                'name' => 'Thể Dục 12',
            ],
            [
                'name' => 'Quốc Phòng 12',
            ],
            [
                'name' => 'Giáo Dục Công Dân 12',
            ],
            [
                'name' => 'Công Nghệ 12',
            ],
            [
                'name' => 'Chung',
            ],
        ]);
    }
}
