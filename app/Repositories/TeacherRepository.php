<?php

namespace App\Repositories;

use App\Models\Teacher;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    private $teacher;

    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }
    
    public function getAll($offset = 10)
    {
        return $this->teacher->join('departments', 'department_id', 'departments.id')
            ->select('teachers.id', 'username', 'teachers.name', 'department_id', 'gender', 'date_of_birth', 'address', 'phone', 'email', DB::raw('departments.name as department_name'))
            ->paginate($offset);
    }

    public function getByKey($key, $offset = 10)
    {
        return $this->teacher->join('departments', 'department_id', 'departments.id')
            ->where('username', 'like', '%'.$key.'%')
            ->orWhere('teachers.name', 'like', '%'.$key.'%')
            ->select('teachers.id', 'username', 'teachers.name', 'department_id', 'gender', 'date_of_birth', 'address', 'phone', 'email', DB::raw('departments.name as department_name'))
            ->paginate($offset);
    }

    public function getById($id)
    {
        return $this->teacher->join('departments', 'department_id', 'departments.id')
            ->where('teachers.id', $id)
            ->select('teachers.id', 'username', 'teachers.name', 'department_id', 'gender', 'date_of_birth', 'address', 'phone', 'email', DB::raw('departments.name as department_name'))
            ->first();
    }

    public function getNameById($id)
    {
        return $this->teacher->select('name')->find($id);
    }

    public function create($collection = [])
    {
        return $this->teacher->create([
            'username' => $collection['username'],
            'name' => $collection['name'],
            'date_of_birth' => date('Y-m-d', strtotime($collection['date_of_birth'])),
            'gender' => $collection['gender'],
            'department_id' => $collection['department'],
            'address' => $collection['address'],
            'phone' => $collection['phone'],
            'email' => $collection['email'],
            'password' => Hash::make($collection['password'])
        ]);
    }

    public function update($id, $collection = [])
    {
        return $this->teacher->find($id)->update([
            'username' => $collection['username'],
            'name' => $collection['name'],
            'date_of_birth' => date('Y-m-d', strtotime($collection['date_of_birth'])),
            'gender' => $collection['gender'],
            'department_id' => $collection['department'],
            'address' => $collection['address'],
            'phone' => $collection['phone'],
            'email' => $collection['email'],
        ]);
    }

    public function delete($id)
    {
        return $this->teacher->find($id)->delete();
    }

    public function updatePasswordById($id, $collection = [])
    {
        return $this->teacher->find($id)->update([
            'password' => Hash::make($collection['password']),
        ]);
    }
}