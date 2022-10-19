<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercise_documents')->insert([
            [
                'exercise_id' => 1,
                'name' => 'Bài tập chương 1',
                'link' => 'bai-tap-chuong-1.pdf',
            ]
        ]);
    }
}
