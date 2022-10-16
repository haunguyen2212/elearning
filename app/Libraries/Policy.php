<?php

namespace App\Libraries;

class Policy{

    private $courseInvolvement;

    public function __construct()
    {
        $this->courseInvolvement = app('App\Repositories\Interfaces\CourseInvolvementRepositoryInterface');
    }

    const VIEW_ANY = 1;
    const VIEW = 2;
    const CREATE = 3;
    const UPDATE = 4;
    const DELETE = 5;
    const RESTORE = 6;
    const FORCE_DELETE = 7;

    public function courseStudent($course_id){
        if(!$this->courseInvolvement->checkEnrol(auth()->guard('student')->id(), $course_id)){
            abort(403);
        };
        return true;
    }

}