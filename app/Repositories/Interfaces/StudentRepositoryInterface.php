<?php

namespace App\Repositories\Interfaces;

interface StudentRepositoryInterface{

    public function getAll($offset = 10);
    public function getById($id);
    public function getByKey($key, $offset = 10);
    public function getNameById($id);
    public function getStatusAccount($username);
    public function create($collection = []);
    public function update($id, $collection = []);
    public function delete($id);
    public function updatePasswordById($id, $collection = []);
    public function lock($id);
    public function unlock($id);
    public function getByIdOfCurrent($school_year, $id);

}