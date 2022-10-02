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

    public function getDropdown()
    {
        return $this->department->select('id', 'name')->get();
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

    public function getById($id)
    {
        return $this->department->select('id', 'name')->find($id);
    }

    public function getByKey($key, $offset = 10)
    {
        $departmentNoneMember = $this->department->leftJoin('teachers', 'department_id', 'departments.id')
            ->where('departments.name', 'like', '%'.$key.'%')
            ->select('departments.id', 'departments.name', DB::raw('COUNT(teachers.id) as total'))
            ->groupBy('departments.id', 'departments.name')
            ->having('total', 0);

        $departments = $this->department->leftJoin('teachers', 'department_id', 'departments.id')
            ->where('active','1')
            ->where('departments.name', 'like', '%'.$key.'%')
            ->select('departments.id', 'departments.name', DB::raw('COUNT(teachers.id) as total'))
            ->groupBy('departments.id', 'departments.name')
            ->union($departmentNoneMember);

        return $departments->orderBy('id', 'asc')->paginate($offset);
    }

    public function getTeachersById($id)
    {
        return $this->department->find($id)->teachers()->where('teachers.active', '1')->get();
    }

    public function count()
    {
        return $this->department->count();
    }

    public function countTotalTeacher($id)
    {
        return $this->department->leftJoin('teachers', 'teachers.department_id', 'departments.id')
        ->where('teachers.active', '1')
        ->where('departments.id', $id)
        ->select('departments.id',DB::raw('COUNT(teachers.id) as total'))
        ->groupBy('departments.id')
        ->first();
    }

    public function create($collection = [])
    {
        return $this->department->create([
            'name' => $collection['name'],
        ]);
    }

    public function update($id, $collection = [])
    {
        return $this->department->find($id)->update([
            'name' => $collection['name'],
        ]);
    }

    public function delete($id)
    {
        return $this->department->find($id)->delete();
    }
    
}