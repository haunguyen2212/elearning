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
                'course_id' => 1,
                'student_id' => 5,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 6,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 7,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 10,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 11,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 12,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 15,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 20,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 21,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 22,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 23,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 24,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'course_id' => 1,
                'student_id' => 25,
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
