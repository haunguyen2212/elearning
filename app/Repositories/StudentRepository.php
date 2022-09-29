<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface{

    private $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function getAll($offset = 10)
    {
        return $this->student->select('students.id', 'username', 'students.name', 'date_of_birth', 'gender', 'place_of_birth', 'address', 'active', 'phone', 'email')
        ->orderBy('students.id', 'asc')
        ->paginate($offset);
    }

    public function getById($id){
        return $this->student->where('students.id', $id)
            ->select('students.id', 'username', 'students.name', 'date_of_birth', 'gender', 'place_of_birth', 'address', 'active', 'phone', 'email')
            ->first();
    }

    public function getByKey($key, $offset = 10)
    {
        return $this->student->where('username', 'like', '%'.$key.'%')
            ->orWhere('students.name', 'like', '%'.$key.'%')
            ->select('students.id', 'username', 'students.name', 'date_of_birth', 'gender', 'place_of_birth', 'active')
            ->paginate($offset);
    }

    public function getStatusAccount($username)
    {
        return $this->student->where('username', $username)->first()->active;
    }

    public function getNameById($id)
    {
        return $this->student->select('name')->find($id);
    }

    public function create($collection = [])
    {
        return $this->student->create([
            'username' => $collection['username'],
            'name' => $collection['name'],
            'date_of_birth' => date('Y-m-d', strtotime($collection['date_of_birth'])),
            'gender' => $collection['gender'],
            'place_of_birth' => $collection['place_of_birth'],
            'class_id' => $collection['class'],
            'address' => $collection['address'],
            'phone' => $collection['phone'],
            'email' => $collection['email'],
            'password' => Hash::make($collection['password'])
        ]);
    }

    public function update($id, $collection = [])
    {
        return $this->student->find($id)->update([
            'username' => $collection['username'],
            'name' => $collection['name'],
            'date_of_birth' => date('Y-m-d', strtotime($collection['date_of_birth'])),
            'gender' => $collection['gender'],
            'place_of_birth' => $collection['place_of_birth'],
            'class_id' => $collection['class'],
            'address' => $collection['address'],
            'phone' => $collection['phone'],
            'email' => $collection['email'],
        ]);
    }

    public function delete($id)
    {
        return $this->student->find($id)->delete();
    }

    public function updatePasswordById($id, $collection = [])
    {
        return $this->student->find($id)->update([
            'password' => Hash::make($collection['password']),
        ]);
    }

    public function lock($id){
        return $this->student->find($id)->update([
            'active' => 0,
        ]);
    }

    public function unlock($id){
        return $this->student->find($id)->update([
            'active' => 1,
        ]);
    }
    
    public function getByIdOfCurrent($school_year, $id)
    {
        $data = $this->student->leftJoin('classroom', 'classroom.student_id', 'students.id')
        ->leftJoin('classes', 'classroom.class_id', 'classes.id')
        ->where('students.id', $id)
        ->where('school_year_id', $school_year)
        ->select('students.*', 'class_id', DB::raw('classes.name as class_name'), 'school_year_id')
        ->first();
        if(empty($data)){
            return $this->student->where('students.id', $id)->first();
        }
        else{
            return  $data;
        }
            
    }
}