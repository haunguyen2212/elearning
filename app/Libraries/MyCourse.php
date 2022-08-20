<?php

namespace App\Libraries;

class MyCourse{

    protected $courseInvolvement, $course;

    public function __construct()
    {
        $this->courseInvolvement = app('App\Repositories\Interfaces\CourseInvolvementRepositoryInterface');
        $this->course = app('App\Repositories\Interfaces\CourseRepositoryInterface');
    }

    public function getCourseOfStudent(){
        return $this->courseInvolvement->getCourseOfStudent();
    }

    public function getCourseOfTeacher(){
        return $this->course->getCourseOfTeacher();
    }
}