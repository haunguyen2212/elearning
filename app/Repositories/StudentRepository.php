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
        return $this->student->leftJoin('classes', 'class_id', 'classes.id')
        ->select('students.id', 'username', 'students.name', 'date_of_birth', 'gender', 'place_of_birth', 'address', 'active', 'phone', 'email', DB::raw('classes.id as class_id, classes.name as class_name'))
        ->paginate($offset);
    }

    public function getById($id){
        return $this->student->leftJoin('classes', 'class_id', 'classes.id')
        ->where('students.id', $id)
        ->select('students.id', 'username', 'students.name', 'date_of_birth', 'gender', 'place_of_birth', 'address', 'active', 'phone', 'email', DB::raw('classes.id as class_id, classes.name as class_name'))
        ->first();
    }

    public function getByKey($key, $offset = 10)
    {
        return $this->student->leftJoin('classes', 'class_id', 'classes.id')
            ->where('username', 'like', '%'.$key.'%')
            ->orWhere('students.name', 'like', '%'.$key.'%')
            ->select('students.id', 'username', 'students.name', 'date_of_birth', 'gender', 'place_of_birth', 'active', DB::raw('classes.id as class_id, classes.name as class_name'))
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
    
}