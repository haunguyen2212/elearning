<?php

namespace App\Repositories;

use App\Models\SchoolYear;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface;

class SchoolYearRepository implements SchoolYearRepositoryInterface{

    private $schoolYear;

    public function __construct(
        SchoolYear $schoolYear
    )
    {
        $this->schoolYear = $schoolYear;
    }

    public function getCurrent()
    {
        return $this->schoolYear->where('status', 1)->first();
    }

    public function getAll($offset = 10)
    {
        return $this->schoolYear->orderBy('status', 'desc')->orderBy('name', 'desc')->paginate($offset);
    }

    public function changeToCurrent($id)
    {
        $this->schoolYear->where('status', 1)->update([
            'status' => 0,
        ]);

        return $this->schoolYear->find($id)->update([
            'status' => 1,
        ]);
    }

    public function getById($id)
    {
        return $this->schoolYear->find($id);
    }

    public function create($collection = [])
    {
        return $this->schoolYear->create([
            'name' => $collection['name'],
            'start_time' => $collection['start_time'],
            'end_time' => $collection['end_time'],
            'status' => $collection['status'] ?? 0,
        ]);
    }

    public function update($id, $collection = [])
    {
        return $this->schoolYear->find($id)->update([
            'name' => $collection['name'],
            'start_time' => $collection['start_time'],
            'end_time' => $collection['end_time'],
            'status' => $collection['status'] ?? 0,
        ]);
    }

    public function delete($id)
    {
        return $this->schoolYear->find($id)->delete();
    }

}