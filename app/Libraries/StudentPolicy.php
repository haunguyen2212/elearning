<?php

namespace App\Libraries;

class StudentPolicy{

    private $course, $courseInvolvement, $schoolYear;

    public function __construct()
    {
        $this->course = app('App\Repositories\Interfaces\CourseRepositoryInterface');
        $this->courseInvolvement = app('App\Repositories\Interfaces\CourseInvolvementRepositoryInterface');
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current(); 
    }

    const VIEW_ANY = 1;
    const VIEW = 2;
    const CREATE = 3;
    const UPDATE = 4;
    const DELETE = 5;
    const RESTORE = 6;
    const FORCE_DELETE = 7;

    public function course($course_id){
        if(!$this->courseInvolvement->checkEnrol(auth()->guard('student')->id(), $course_id)){
            abort(403);
        };
        if(!$this->course->checkCourseOfCurrent($this->schoolYear->id, $course_id)){
            abort(404);
        }
        return true;
    }

}