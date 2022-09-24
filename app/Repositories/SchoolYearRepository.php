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

}