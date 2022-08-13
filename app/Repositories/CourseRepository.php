<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CourseRepository implements CourseRepositoryInterface
{
    private $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function getAll($offset = 10)
    {
        return $this->course->paginate($offset);
    }

    public function getFullInfo($offset = 10)
    {
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->select('courses.id', 'courses.name', 'code', 'introduce', 'is_enrol', 'notice', 'teacher_id' ,DB::raw('teachers.name as teacher_name'))
            ->paginate($offset);
    }

    public function getFullById($id){
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->where('courses.id', $id)
            ->select('courses.id', 'courses.name', 'code', 'introduce', 'is_enrol', 'notice', 'teacher_id' ,DB::raw('teachers.name as teacher_name'))
            ->first();
    }

    public function count()
    {
        return $this->course->count();
    }
}