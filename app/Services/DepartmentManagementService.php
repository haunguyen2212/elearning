<?php

namespace App\Services;

use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Services\Interfaces\DepartmentManagementServiceInterface;

class DepartmentManagementService implements DepartmentManagementServiceInterface{

    private $department;

    public function __construct(
        DepartmentRepositoryInterface $departmentRepository
    )
    {
        $this->department = $departmentRepository;
    }

    public function index()
    {
        return $this->department->getAll();
    }

    public function getAll(){
        return $this->department->getAll($this->count());
    }
    
    public function count()
    {
        return $this->department->count();
    }
}