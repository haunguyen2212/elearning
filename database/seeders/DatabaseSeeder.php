<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SchoolYearSeeder::class,
            ClassSeeder::class,
            StudentSeeder::class,
            DepartmentSeeder::class,
            TeacherSeeder::class,
            AdminSeeder::class,
            HomeroomTeacherSeeder::class,
            SubjectSeeder::class,
            CourseSeeder::class,
            CourseInvolvementSeeder::class,
            QuestionSeeder::class,
            TopicSeeder::class,
            TopicDocumentSeeder::class,
            QuizSeeder::class,
            QuizDetailSeeder::class,
            NoticeSeeder::class,
            RoomRegistrationSeeder::class,
            RoomSeeder::class,
            RoomAssignmentSeeder::class,
            ClassroomSeeder::class,
            ExerciseSeeder::class,
            ExerciseDocumentSeeder::class,
            SubmitExerciseSeeder::class,
       ]);
    }
}
