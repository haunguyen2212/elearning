<?php

namespace App\Repositories\Interfaces;

interface SchoolYearRepositoryInterface{

    public function getCurrent();
    public function getAll($offset = 10);
}