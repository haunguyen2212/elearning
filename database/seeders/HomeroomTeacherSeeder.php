<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeroomTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d');
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        
        DB::table('homeroom_teachers')->insert([
            [
                'class_id' => 1,
                'teacher_id' => 2,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 2,
                'teacher_id' => 3,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 3,
                'teacher_id' => 4,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 4,
                'teacher_id' => 6,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 5,
                'teacher_id' => 33,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 6,
                'teacher_id' => 32,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 7,
                'teacher_id' => 10,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 8,
                'teacher_id' => 24,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 9,
                'teacher_id' => 1,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
