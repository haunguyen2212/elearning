<?php

namespace App\Repositories\Interfaces;

interface CourseRepositoryInterface{

    public function getAll($offset = 10);
    public function count();
    public function getFullInfo($offset = 10);
    public function getFullById($id);

}