<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ClassroomRepositoryInterface;
use App\Models\Classroom;

class ClassroomRepository implements ClassroomRepositoryInterface{

    protected $classroom;

    public function __construct(
        Classroom $classroom
    )
    {
        $this->classroom = $classroom;
    }

    public function create($collection = [])
    {
        return $this->classroom->create([
            'class_id' => $collection['class_id'],
            'student_id' => $collection['student_id'],
        ]);
    }

    public function update($id, $collection = [])
    {
        return $this->classroom->find($id)->update([
            'class_id' => $collection['class_id'],
        ]);
    }

    public function findClassOfStudent($class_id, $student_id)
    {
        return $this->classroom->where('class_id', $class_id)->where('student_id', $student_id)->first();
    }

}