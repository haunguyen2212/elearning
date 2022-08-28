<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $now = Carbon::now();
        DB::table('notices')->insert([
            [
                'name' => 'Thông báo kế hoạch giảng dạy năm học 2022-2023.',
                'link' => 'Ke-hoach-giang-day-nam-hoc-2022.docx',
                'start_time' => $now->format('Y-m-d'),
                'end_time' => $now->addWeeks(1)->format('Y-m-d'),
            ],
            [
                'name' => 'Quy định công tác học vụ từ năm học 2022-2023.',
                'link' => 'Quy-dinh-cong-tac-hoc-vu-nam-hoc-2022.docx',
                'start_time' => $now->subWeeks(1)->subDays(2)->format('Y-m-d'),
                'end_time' => $now->addWeeks(3)->format('Y-m-d'),
            ],
            [
                'name' => 'Công văn quy định mức học phí năm học 2022-2023.',
                'link' => 'Cong-van-quy-dinh-muc-hoc-phi-nam-hoc-2022-2023.docx',
                'start_time' => $now->subWeeks(3)->subDays(5)->format('Y-m-d'),
                'end_time' => $now->addWeeks(3)->format('Y-m-d'),
            ],
            [
                'name' => 'Sơ đồ nhà học - Ký hiệu phòng học.',
                'link' => 'So-do-nha-hoc.docx',
                'start_time' => $now->subWeeks(3)->subDays(5)->format('Y-m-d'),
                'end_time' => $now->addWeeks(3)->addHours(8)->format('Y-m-d'),
            ],
        ]);
    }
}
