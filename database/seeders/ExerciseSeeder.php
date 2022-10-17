<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercises')->insert([
            [
                'topic_id' => 1,
                'name' => 'Nộp bài tập chương 1',
                'content' => 'Nộp bài tập chương 1 tại đây',
                'assignment_date' => Carbon::now()->subWeeks(1)->format('Y-m-d H:i:s'),
                'expiration_date' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
