<?php

namespace App\Repositories\Interfaces;

interface DepartmentRepositoryInterface{

    public function getAll($offset = 10);
    public function getFullInfo($offset = 10);
    public function getByKey($key, $offset = 10);
    public function getById($id);
    public function getTeachersById($id);
    public function count();
    public function countTotalTeacher($id);
    public function create($collection = []);
    public function update($id, $collection = []);
    public function delete($id);

}