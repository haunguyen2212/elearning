<?php

namespace App\Repositories\Interfaces;

interface ClassroomRepositoryInterface{

    public function create($collection = []);
    public function update($id, $collection = []);
    public function findClassOfStudent($class_id, $student_id);
}