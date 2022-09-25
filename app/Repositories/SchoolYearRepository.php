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

}