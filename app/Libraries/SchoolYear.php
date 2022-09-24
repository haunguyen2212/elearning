<?php

namespace App\Libraries;


class SchoolYear{

    protected $schoolYear;

    public function __construct()
    {
        $this->schoolYear = app('App\Repositories\Interfaces\SchoolYearRepositoryInterface');
    }

    public function current(){
        return $this->schoolYear->getCurrent();
    }
}