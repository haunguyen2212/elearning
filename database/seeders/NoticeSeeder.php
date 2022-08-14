<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->insert([
            [
                'name' => 'Thông báo kế hoạch giảng dạy năm học 2022-2023.',
                'link' => 'thongbao.pdf',
            ],
            [
                'name' => 'Quy định công tác học vụ từ năm học 2022-2023.',
                'link' => 'thongbao.pdf',
            ],
            [
                'name' => 'Công văn quy định mức học phí năm học 2022-2023.',
                'link' => 'thongbao.pdf',
            ],
            [
                'name' => 'Sơ đồ nhà học - Ký hiệu phòng học.',
                'link' => 'thongbao.pdf',
            ],
        ]);
    }
}
