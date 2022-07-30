<?php

namespace App\Repositories;

use App\Models\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DepartmentRepository implements DepartmentRepositoryInterface{

    private $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function getAll($offset = 10)
    {
        return $this->department->select('id', 'name')->paginate($offset);
    }

    public function getFullInfo($offset = 10)
    {
        $departmentNoneMember = $this->department->leftJoin('teachers', 'department_id', 'departments.id')
            ->select('departments.id', 'departments.name', DB::raw('COUNT(teachers.id) as total'))
            ->groupBy('departments.id', 'departments.name')
            ->having('total', 0);

        $departments = $this->department->leftJoin('teachers', 'department_id', 'departments.id')
            ->where('active','1')
            ->select('departments.id', 'departments.name', DB::raw('COUNT(teachers.id) as total'))
            ->groupBy('departments.id', 'departments.name')
            ->union($departmentNoneMember);

        return $departments->orderBy('id', 'asc')->paginate($offset);
    }

    public function count()
    {
        return $this->department->count();
    }
    
}