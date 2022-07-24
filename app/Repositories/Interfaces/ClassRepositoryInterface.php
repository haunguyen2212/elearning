<?php

namespace App\Repositories\Interfaces;

interface ClassRepositoryInterface{

    public function getAll($offset = 10);
    public function count();

}