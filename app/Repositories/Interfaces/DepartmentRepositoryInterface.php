<?php

namespace App\Repositories\Interfaces;

interface DepartmentRepositoryInterface{

    public function getAll($offset = 10);
    public function getFullInfo($offset = 10);
    public function count();

}