<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface{

    public function getAll($offset = 10)
    {
        return User::join('classes', 'class_id', 'classes.id')
        ->select('students.id', 'username', 'students.name', 'date_of_birth', 'gender', 'place_of_birth', 'address', 'phone', 'email', DB::raw('classes.id as class_id, classes.name as class_name'))
        ->paginate($offset);
    }

    public function getById($id){
        return User::join('classes', 'class_id', 'classes.id')
        ->where('students.id', $id)
        ->select('students.id', 'username', 'students.name', 'date_of_birth', 'gender', 'place_of_birth', 'address', 'phone', 'email', DB::raw('classes.id as class_id, classes.name as class_name'))
        ->first();
    }

    public function getByKey($key, $offset = 10)
    {
        return User::join('classes', 'class_id', 'classes.id')
            ->where('username', 'like', '%'.$key.'%')
            ->orWhere('students.name', 'like', '%'.$key.'%')
            ->select('students.id', 'username', 'students.name', 'date_of_birth', 'gender', 'place_of_birth', DB::raw('classes.id as class_id, classes.name as class_name'))
            ->paginate($offset);
    }

    public function getNameById($id)
    {
        return User::select('name')->find($id);
    }

    public function create($collection = [])
    {
        return User::create([
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
        return User::find($id)->update([
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
        return User::find($id)->delete();
    }

    public function updatePasswordById($id, $collection = [])
    {
        return User::find($id)->update([
            'password' => Hash::make($collection['password']),
        ]);
    }
    
}