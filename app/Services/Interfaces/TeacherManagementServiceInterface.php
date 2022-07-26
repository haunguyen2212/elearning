<?php

namespace App\Services\Interfaces;

interface TeacherManagementServiceInterface{

    public function index();
    public function search($key);
    public function store($collection = []);
    public function getById($id);
    public function update($id, $collection = []);
    public function delete($id);
    public function getNameById($id);
    public function updatePassword($id, $collection = []);

}