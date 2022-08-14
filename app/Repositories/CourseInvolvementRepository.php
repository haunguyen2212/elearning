<?php

namespace App\Repositories;

use App\Models\CourseInvolvement;
use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseInvolvementRepository implements CourseInvolvementRepositoryInterface
{
    private $courseInvolvement, $course;

    public function __construct(
        CourseInvolvement $courseInvolvement
    )
    {
        $this->courseInvolvement = $courseInvolvement;
    }

    public function getCourseOfStudent($orderBy = 'asc')
    {
        return $this->courseInvolvement->join('courses', 'course_id', 'courses.id')->where('student_id', Auth::guard('student')->id())->select('course_involvement.id', 'course_id', 'code' ,DB::raw('courses.name as course_name'))->orderBy('id', $orderBy)->get();
    }

    public function checkEnrol($student_id, $course_id)
    {
        $count = $this->courseInvolvement->where('student_id', $student_id)->where('course_id', $course_id)->count();
        return $count == 0;
    }

    public function create($collection = [])
    {
        return $this->courseInvolvement->create([
            'course_id' => $collection['course_id'],
            'student_id' => $collection['student_id']
        ]);
    }
}