<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quiz_details')->insert([
            [
                'quiz_id' => 1,
                'question_id' => 1,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 2,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 3,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 4,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 5,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 6,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 10,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 12,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 13,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 14,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 15,
            ],
            [
                'quiz_id' => 1,
                'question_id' => 16,
            ],
        ]);
    }
}
