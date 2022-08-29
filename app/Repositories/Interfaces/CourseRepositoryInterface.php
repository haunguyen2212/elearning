<?php

namespace App\Repositories\Interfaces;

interface CourseRepositoryInterface{

    public function getAll($offset = 10);
    public function getAllActive($offset = 10);
    public function count();
    public function getFullInfo($offset = 10);
    public function getFullById($id);
    public function getByKey($key, $offset = 10);
    public function getCourseOfTeacher($orderBy = 'asc');
    public function create($collection = []);
    public function hide($id);
    public function show($id);
    public function delete($id);

}