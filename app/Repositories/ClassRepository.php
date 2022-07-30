<?php

namespace App\Repositories;

use App\Models\Classes;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ClassRepository implements ClassRepositoryInterface{

    private $class;

    public function __construct(Classes $class)
    {
        $this->class = $class;
    }

    public function getAll($offset = 10)
    {
        return $this->class->select('id', 'name')->paginate($offset);
    }

    public function count()
    {
        return $this->class->count();
    }

    public function getFullInfo($offset = 10)
    {
        $classNoneStudent = $this->class->leftJoin('students', 'students.class_id', 'classes.id')
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.class_id', 'classes.id')
            ->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->select('classes.id', 'classes.name', DB::raw('teachers.name as teacher_name, COUNT(students.id) as total'))
            ->groupBy('classes.id', 'classes.name', 'teacher_name')
            ->having('total', 0);

        $classes = $this->class->leftJoin('students', 'students.class_id', 'classes.id')
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.class_id', 'classes.id')
            ->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->where('students.active', '1')
            ->whereNull('end_date')
            ->select('classes.id', 'classes.name', DB::raw('teachers.name as teacher_name, COUNT(students.id) as total'))
            ->groupBy('classes.id', 'classes.name', 'teacher_name')
            ->union($classNoneStudent);

            return $classes->orderBy('id', 'asc')->paginate($offset);
    }
    

    public function getById($id)
    {
        return $this->class->where('id', $id)->select('id', 'name')->first();
    }

    public function getHomeroomTeacherActive($id)
    {
        return $this->class->leftJoin('homeroom_teachers', 'class_id', 'classes.id')
            ->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->whereNull('end_date')
            ->where('classes.id', $id)
            ->first();
    }

    public function countTotalStudent($id)
    {
        return $this->class->leftJoin('students', 'students.class_id', 'classes.id')
        ->where('students.active', '1')
        ->where('classes.id', $id)
        ->select('classes.id',DB::raw('COUNT(students.id) as total'))
        ->groupBy('classes.id')
        ->first();
    }

    public function getStudentsById($id)
    {
        return $this->class->find($id)->students()->where('students.active', '1')->get();
    }

    public function create($collection = [])
    {
        return $this->class->create([
            'name' => $collection['name'],
        ]);
    }

    public function getByKey($key, $offset = 10)
    {
        $classNoneStudent = $this->class->leftJoin('students', 'students.class_id', 'classes.id')
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.class_id', 'classes.id')
            ->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->where('classes.name', 'like', '%'.$key.'%')
            ->select('classes.id', 'classes.name', DB::raw('teachers.name as teacher_name, COUNT(students.id) as total'))
            ->groupBy('classes.id', 'classes.name', 'teacher_name')
            ->having('total', 0);

        return $this->class->leftJoin('students', 'students.class_id', 'classes.id')
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.class_id', 'classes.id')
            ->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->where('students.active', '1')
            ->whereNull('end_date')
            ->where('classes.name', 'like', '%'.$key.'%')
            ->select('classes.id', 'classes.name', DB::raw('teachers.name as teacher_name, COUNT(students.id) as total'))
            ->groupBy('classes.id', 'classes.name', 'teacher_name')
            ->union($classNoneStudent)
            ->paginate($offset);
    }

    public function update($id, $collection = [])
    {
        return $this->class->find($id)->update([
            'name' => $collection['name'],
        ]);
    }
    
    public function delete($id)
    {
        return $this->class->find($id)->delete();
    }
}