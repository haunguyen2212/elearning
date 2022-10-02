<?php

namespace App\Repositories\Interfaces;

interface ClassRepositoryInterface{

    public function getAll($offset = 10);
    public function count();
    public function getFullInfo($offset = 10);
    public function getById($id);
    public function getByKey($key, $offset = 10);
    public function getHomeroomTeacherActive($id);
    public function countTotalStudent($id);
    public function getStudentsById($id);
    public function create($collection = []);
    public function update($id, $collection = []);
    public function delete($id);
    public function getAllOfCurrent($school_year, $offset = 10);
    public function getFullInfoOfCurrent($school_year, $offset = 10);
    public function getByKeyOfCurrent($school_year, $key, $offset = 10);
    public function getDropDownOfCurrent($school_year);

}