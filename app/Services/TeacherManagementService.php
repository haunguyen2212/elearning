<?php

namespace App\Services;

use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Services\Interfaces\TeacherManagementServiceInterface;

class TeacherManagementService implements TeacherManagementServiceInterface{

    private $teacher;

    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacher = $teacherRepository;
    }

    public function index()
    {
        return $this->teacher->getAll(20);
    }

    public function search($key)
    {
        return $this->teacher->getByKey($key, 20);
    }
    
    public function store($collection = []){
        return $this->teacher->create($collection);
    }

    public function getById($id)
    {
        return $this->teacher->getById($id);
    }

    public function update($id, $collection = [])
    {
        return $this->teacher->update($id, $collection);
    }

    public function delete($id)
    {
        return $this->teacher->delete($id);
    }

    public function getNameById($id)
    {
        return $this->teacher->getNameById($id);
    }

    public function updatePassword($id, $collection = [])
    {
        return $this->teacher->updatePasswordById($id, $collection);
    }
}