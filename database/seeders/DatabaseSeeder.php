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
            ClassSeeder::class,
            StudentSeeder::class,
            DepartmentSeeder::class,
            TeacherSeeder::class,
            AdminSeeder::class,
            HomeroomTeacherSeeder::class,
            CourseSeeder::class,
            CourseInvolvementSeeder::class,
            QuizSeeder::class,
            QuestionSeeder::class,
            TopicSeeder::class,
            TopicDocumentSeeder::class,
            NoticeSeeder::class,
            RoomRegistrationSeeder::class,
       ]);
    }
}
