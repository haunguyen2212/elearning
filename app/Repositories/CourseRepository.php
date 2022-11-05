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
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->where('is_show', 1)->select('courses.*', DB::raw('teachers.name as teacher_name, subjects.name as subject_name'))->paginate($offset);
    }

    public function getFullInfo($offset = 10)
    {
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->select('courses.id', 'courses.name', 'code', 'introduce', 'is_enrol', 'courses.is_show', 'notice', 'teacher_id', 'subject_id' ,DB::raw('teachers.name as teacher_name, subjects.name as subject_name'))
            ->paginate($offset);
    }

    public function getFullById($id){
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->where('courses.id', $id)
            ->select('courses.id', 'courses.name', 'code', 'introduce', 'is_enrol', 'is_show', 'notice', 'teacher_id', 'subject_id' ,DB::raw('teachers.name as teacher_name, subjects.name as subject_name'))
            ->first();
    }

    public function getByKey($key, $offset = 10)
    {
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->where('code', 'like', '%'.$key.'%')
            ->orWhere('courses.name', 'like', '%'.$key.'%')
            ->select('courses.*', DB::raw('teachers.name as teacher_name, subjects.name as subject_name'))
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
            'school_year_id' => $collection['school_year_id'],
            'subject_id' => $collection['subject_id'],
        ]);
    }

    public function update($id, $collection = []){
        return $this->course->find($id)->update([
            'code' => $collection['code'],
            'name' => $collection['name'],
            'teacher_id' => $collection['teacher_id'],
            'introduce' => $collection['introduce'] ?? '',
            'is_enrol' => $collection['is_enrol'] ?? '1',
            'is_show' => $collection['is_show'],
            'subject_id' => $collection['subject_id'],
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

    public function getCourseNameTeacher($teacher_id)
    {
        return $this->course->where('teacher_id', $teacher_id)->select('name')->get();
    }

    public function getByKeyOfCurrent($school_year, $key, $offset = 10)
    {
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->where('school_year_id', $school_year)
            ->where(function ($q) use ($key) {
                $q->where('code', 'like', '%'.$key.'%')
                ->orWhere('courses.name', 'like', '%'.$key.'%');
            })
            ->select('courses.*', DB::raw('teachers.name as teacher_name, subjects.name as subject_name'))
            ->orderBy('id', 'desc')
            ->paginate($offset);
    }

    public function getFullInfoOfCurrent($school_year, $offset = 10)
    {
        return $this->course->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->where('school_year_id', $school_year)
            ->select('courses.id', 'courses.name', 'code', 'introduce', 'is_enrol', 'courses.is_show', 'notice', 'teacher_id' ,DB::raw('teachers.name as teacher_name, subjects.name as subject_name'))
            ->orderBy('id', 'desc')
            ->paginate($offset);
    }

    public function getAllActiveOfCurrent($school_year, $offset = 10)
    {
        return $this->course->leftJoin('teachers', 'teacher_id', '=', 'teachers.id')
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->where('courses.school_year_id', $school_year)
            ->where('is_show', 1)
            ->select('courses.*', DB::raw('teachers.name as teacher_name, subjects.name as subject_name'))
            ->paginate($offset);
    }

    public function getCourseOfTeacherOfCurrent($school_year, $orderBy = 'asc')
    {
        return $this->course->where('teacher_id', Auth::guard('teacher')->id())->where('school_year_id', $school_year)->orderBy('id', $orderBy)->get();
    }

    public function searchByKeyOfCurrent($key, $school_year, $offset = 10)
    {
        return $this->course->leftJoin('teachers', 'teacher_id', '=', 'teachers.id')
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->where('courses.school_year_id', $school_year)
            ->where(function($q) use ($key){
                $q->where('courses.code', 'like', '%'.$key.'%')
                    ->orWhere('courses.name', 'like', '%'.$key.'%');
            })
            ->where('is_show', 1)
            ->select('courses.*', DB::raw('teachers.name as teacher_name, subjects.name as subject_name'))
            ->paginate($offset);
    }

    public function getStudentOfCourse($id)
    {
        return $this->course->join('course_involvement', 'course_id', 'courses.id')
            ->leftJoin('students', 'student_id', 'students.id')
            ->where('courses.id', $id)
            ->select('students.*')
            ->orderBy('students.username', 'asc')
            ->get();
    }

    public function updateNotice($id, $collection = [])
    {
        return $this->course->find($id)->update([
            'notice' => $collection['notice'],
        ]);
    }

    public function changeEnrol($id, $value = 1)
    {
        return $this->course->find($id)->update([
            'is_enrol' => $value,
        ]);
    }

    public function checkCourseOfCurrent($school_year, $id)
    {
        return $this->course->where('id', $id)->where('school_year_id', $school_year)->count() > 0;
    }

    public function checkCourseOfTeacher($teacher_id, $course_id)
    {
        return $this->course->where('id', $course_id)->where('teacher_id', $teacher_id)->count() > 0;
    }
}