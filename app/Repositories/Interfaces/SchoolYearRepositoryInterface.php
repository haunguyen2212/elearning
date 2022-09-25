<?php

namespace App\Repositories\Interfaces;

interface SchoolYearRepositoryInterface{

    public function getCurrent();
    public function getAll($offset = 10);
    public function getById($id);
    public function changeToCurrent($id);
    public function create($collection = []);
    public function update($id, $collection = []);
}