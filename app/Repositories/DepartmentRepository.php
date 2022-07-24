<?php

namespace App\Repositories;

use App\Models\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface{

    public function getAll($offset = 10)
    {
        return Department::select('id', 'name')->paginate($offset);
    }

    public function count()
    {
        return Department::count();
    }
    
}