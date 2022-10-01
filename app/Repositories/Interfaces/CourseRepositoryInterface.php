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
    public function update($id, $collection = []);
    public function hide($id);
    public function show($id);
    public function delete($id);
    public function getCourseNameTeacher($teacher_id);
    public function getByKeyOfCurrent($school_year, $key, $offset = 10);
    public function getFullInfoOfCurrent($school_year, $offset = 10);
    public function getAllActiveOfCurrent($school_year, $offset = 10);
    public function searchByKeyOfCurrent($key, $school_year, $offset = 10);
    public function getCourseOfTeacherOfCurrent($school_year, $orderBy = 'asc');

}