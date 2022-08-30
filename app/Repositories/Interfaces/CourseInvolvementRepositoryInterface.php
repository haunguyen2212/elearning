<?php

namespace App\Repositories\Interfaces;

interface CourseInvolvementRepositoryInterface{

    public function getCourseOfStudent($orderBy = 'asc');
    public function create($collection = []);
    public function checkEnrol($student_id, $course_id);
    public function countStudentEnrol($course_id);
    public function getCourseNameStudent($student_id);
}