<?php

namespace App\Repositories\Interfaces;

interface ClassRepositoryInterface{

    public function getAll($offset = 10);
    public function count();
    public function getFullInfo($offset = 10);
    public function getById($id);
    public function getHomeroomTeacherActive($id);
    public function countTotalStudent($id);
    public function getStudentsById($id);
    public function create($collection = []);

}