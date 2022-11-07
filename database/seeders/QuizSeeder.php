<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('quizzes')->insert([
            [
                'name' => 'Thi giữa kỳ',
                'topic_id' => 1,
                'subject_id' => 1,
                'duration' => 20,
                'start_time' => $dateTime,
                'end_time' => Carbon::now()->addDays(3)->format('Y-m-d H:i:s'),
                'maximum' => 1,
                'password' => '12345678',
                'is_show' => 0,
            ],   
        ]);
    }
}
