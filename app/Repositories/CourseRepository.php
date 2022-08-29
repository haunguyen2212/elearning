<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Facades\Auth;
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

    public function getAllActive($offset = 10){
        return $this->course->leftJoin('teachers', 'teacher_id', '=', 'teachers.id')
            ->where('is_show', 1)->select('courses.*', DB::raw('teachers.name as teacher_name'))->paginate($offset);
    }

    public function getFullInfo($offset = 10)
    {
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->select('courses.id', 'courses.name', 'code', 'introduce', 'is_enrol', 'courses.is_show', 'notice', 'teacher_id' ,DB::raw('teachers.name as teacher_name'))
            ->paginate($offset);
    }

    public function getFullById($id){
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->where('courses.id', $id)
            ->select('courses.id', 'courses.name', 'code', 'introduce', 'is_enrol', 'is_show', 'notice', 'teacher_id' ,DB::raw('teachers.name as teacher_name'))
            ->first();
    }

    public function getByKey($key, $offset = 10)
    {
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->where('code', 'like', '%'.$key.'%')
            ->orWhere('courses.name', 'like', '%'.$key.'%')
            ->select('courses.*', DB::raw('teachers.name as teacher_name'))
            ->paginate($offset);
    }

    public function count()
    {
        return $this->course->count();
    }

    public function getCourseOfTeacher($orderBy = 'asc')
    {
        return $this->course->where('teacher_id', Auth::guard('teacher')->id())->orderBy('id', $orderBy)->get();
    }

    public function create($collection = [])
    {
        return $this->course->create([
            'code' => $collection['code'],
            'name' => $collection['name'],
            'teacher_id' => $collection['teacher_id'],
            'introduce' => $collection['introduce'] ?? '',
            'is_enrol' => $collection['is_enrol'] ?? '1',
        ]);
    }

    public function delete($id)
    {
        return $this->course->find($id)->delete();
    }

    public function hide($id)
    {
        return $this->course->find($id)->update([
            'is_show' => 0,
        ]);
    }

    public function show($id)
    {
        return $this->course->find($id)->update([
            'is_show' => 1,
        ]);
    }
}