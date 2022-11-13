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
            [
                'class_id' => 10,
                'teacher_id' => 12,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 11,
                'teacher_id' => 13,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 12,
                'teacher_id' => 14,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 13,
                'teacher_id' => 15,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 14,
                'teacher_id' => 16,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 15,
                'teacher_id' => 17,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 16,
                'teacher_id' => 18,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 17,
                'teacher_id' => 19,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 18,
                'teacher_id' => 23,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 19,
                'teacher_id' => 39,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 20,
                'teacher_id' => 38,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'class_id' => 21,
                'teacher_id' => 37,
                'start_date' => $date,
                'end_date' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
