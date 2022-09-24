<?php

namespace App\Libraries;

class MyCourse{

    protected $courseInvolvement, $course;

    public function __construct()
    {
        $this->courseInvolvement = app('App\Repositories\Interfaces\CourseInvolvementRepositoryInterface');
        $this->course = app('App\Repositories\Interfaces\CourseRepositoryInterface');
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current();
    }

    public function getCourseOfStudent(){
        return $this->courseInvolvement->getCourseOfStudentOfCurrent($this->schoolYear->id);
    }

    public function getCourseOfTeacher(){
        return $this->course->getCourseOfTeacherOfCurrent($this->schoolYear->id);
    }
}