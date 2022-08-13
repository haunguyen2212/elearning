<?php

namespace App\Repositories\Interfaces;

interface CourseInvolvementRepositoryInterface{

    public function getCourseOfStudent($orderBy = 'asc');

}