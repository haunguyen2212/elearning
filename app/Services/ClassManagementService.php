<?php

namespace App\Services;

use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Services\Interfaces\ClassManagementServiceInterface;

class ClassManagementService implements ClassManagementServiceInterface{

    private $class;

    public function __construct(
        ClassRepositoryInterface $classRepository
    )
    {
        $this->class = $classRepository;
    }

    public function index()
    {
        return $this->class->getAll();
    }

    public function getAll(){
        return $this->class->getAll($this->count());
    }
    
    public function count()
    {
        return $this->class->count();
    }
}