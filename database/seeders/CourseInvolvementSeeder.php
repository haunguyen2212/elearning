<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseInvolvementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        
        DB::table('course_involvement')->insert([
            [
                'course_id' => 1,
                'student_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 7,
                'student_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 10,
                'student_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 14,
                'student_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 16,
                'student_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 18,
                'student_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 22,
                'student_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 7,
                'student_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 10,
                'student_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 14,
                'student_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 16,
                'student_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 18,
                'student_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 24,
                'student_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
