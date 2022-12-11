<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topic_documents')->insert([
            [
                'topic_id' => 1,
                'name' => 'Giới thiệu môn học',
                'link' => 'Giới thiệu môn học.pdf',
                'type' => 1,
            ],
            [
                'topic_id' => 1,
                'name' => 'Danh sách học sinh lớp 10A1',
                'link' => 'Danh sach lop 10A1.pdf',
                'type' => 1,
            ],
            [
                'topic_id' => 1,
                'name' => 'Danh sách học sinh lớp 10A2',
                'link' => 'Giới thiệu môn học.pdf',
                'type' => 1,
            ],
        ]);
    }
}
