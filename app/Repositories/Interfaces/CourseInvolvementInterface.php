<?php

namespace App\Repositories\Interfaces;

interface CourseInvolvementRepositoryInterface{

    public function getCourseOfStudent($course_id, $orderBy = 'asc');

}