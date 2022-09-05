<?php

namespace App\Repositories\Interfaces;

interface RoomRegistrationRepositoryInterface{

    public function getAll($offset = 10);
    public function getForDate($date);
    public function create($collection = [], $is_admin = false);
    public function getOfTeacher($teacher_id, $offset = 10 ,$orderBy = 'desc');
    public function delete($id);

}