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
                'link' => 'Giới thiệu môn học',
                'type' => 1,
            ],
        ]);
    }
}
