<?php

namespace App\Repositories;

use App\Models\Classes;
use App\Repositories\Interfaces\ClassRepositoryInterface;

class ClassRepository implements ClassRepositoryInterface{

    public function getAll($offset = 10)
    {
        return Classes::select('id', 'name')->paginate($offset);
    }

    public function count()
    {
        return Classes::count();
    }
    
}