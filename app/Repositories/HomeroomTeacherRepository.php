<?php

namespace App\Repositories;

use App\Models\HomeroomTeacher;
use App\Repositories\Interfaces\HomeroomTeacherRepositoryInterface;
use Carbon\Carbon;

class HomeroomTeacherRepository implements HomeroomTeacherRepositoryInterface{

    private $homeroomTeacher;

    public function __construct(HomeroomTeacher $homeroomTeacher)
    {
        $this->homeroomTeacher = $homeroomTeacher;
    }

    public function getTeacherActive($class_id)
    {
        return $this->homeroomTeacher->where('class_id', $class_id)->whereNull('end_date')->first();
    }

    public function getAllTeacherActive(){
        return $this->homeroomTeacher->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->whereNull('end_date')->where('active', '1')->get();
    }

    public function create($collection = [])
    {
        return $this->homeroomTeacher->create([
            'class_id' => $collection['class_id'],
            'teacher_id' => $collection['teacher_id'],
            'start_date' => Carbon::now()->format('Y-m-d'),
        ]);
    }

    public function update($id, $collection = [])
    {
        return $this->homeroomTeacher->find($id)->update([
            'teacher_id' => $collection['teacher_id'],
        ]);
    }

    public function setEndDate($id){
        return $this->homeroomTeacher->find($id)->update([
            'end_date' => Carbon::now()->format('Y-m-d'),
        ]);
    }
    
}