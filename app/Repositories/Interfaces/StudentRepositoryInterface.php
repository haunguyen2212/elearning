<?php

namespace App\Repositories\Interfaces;

interface StudentRepositoryInterface{

    public function getAll($offset = 10);
    public function getById($id);
    public function getByKey($key, $offset = 10);
    public function getNameById($id);
    public function create($collection = []);
    public function update($id, $collection = []);
    public function delete($id);
    public function updatePasswordById($id, $collection = []);

}