<?php

namespace App\Repositories\Interfaces;

interface HomeroomTeacherRepositoryInterface{

    public function getTeacherActive($class_id);
    public function getAllTeacherActive();
    public function create($collection = []);
    public function update($id, $collection = []);
    public function setEndDate($id);
    public function getAllTeacherActiveOfCurrent($school_year);

}