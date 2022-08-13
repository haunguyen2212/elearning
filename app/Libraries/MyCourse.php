<?php

namespace App\Libraries;

use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;

class MyCourse{

    protected $courseInvolvement;

    public function __construct()
    {
        $this->courseInvolvement = app('App\Repositories\Interfaces\CourseInvolvementRepositoryInterface');
    }

    public function getCourseOfStudent(){
        return $this->courseInvolvement->getCourseOfStudent();
    }
}