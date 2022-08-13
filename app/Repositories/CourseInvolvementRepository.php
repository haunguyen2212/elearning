<?php

namespace App\Repositories;

use App\Models\CourseInvolvement;
use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;

class CourseInvolvementRepository implements CourseInvolvementRepositoryInterface
{
    private $courseInvolvement;

    public function __construct(CourseInvolvement $courseInvolvement)
    {
        $this->courseInvolvement = $courseInvolvement;
    }

    public function getCourseOfStudent($student_id, $orderBy = 'asc')
    {
        return $this->courseInvolvement->where('student_id', $student_id)->orderBy('id', $orderBy)->get();
    }
}