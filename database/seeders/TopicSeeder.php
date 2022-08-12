<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            [
                'course_id' => 1,
                'title' => 'Kế hoạch giảng dạy',
                'content' => 'Kế hoạch giảng dạy môn toán 10 - Năm học: 2021-2022',
            ],
            [
                'course_id' => 1,
                'title' => 'Bài giảng môn học',
                'content' => 'Danh sách bài giảng môn học cập nhật tại đây',
            ]
            
        ]);
    }
}
