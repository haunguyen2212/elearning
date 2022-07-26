<?php

namespace App\Services;

use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Services\Interfaces\StudentManagementServiceInterface;

class StudentManagementService implements StudentManagementServiceInterface{

    private $student;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->student = $studentRepository;
    }

    public function index()
    {
        return $this->student->getAll(20);
    }

    public function search($key)
    {
        return $this->student->getByKey($key, 20);
    }
    
    public function store($collection = []){
        return $this->student->create($collection);
    }

    public function getById($id)
    {
        return $this->student->getById($id);
    }

    public function update($id, $collection = [])
    {
        return $this->student->update($id, $collection);
    }

    public function delete($id)
    {
        return $this->student->delete($id);
    }

    public function getNameById($id)
    {
        return $this->student->getNameById($id);
    }

    public function updatePassword($id, $collection = [])
    {
        return $this->student->updatePasswordById($id, $collection);
    }
}