<?php

namespace App\Repositories\Interfaces;

interface RoomRegistrationRepositoryInterface{

    public function getAll($offset = 10);
    public function getForDate($date);
    public function create($collection = [], $is_admin = false);
    public function getOfTeacher($teacher_id, $offset = 10 ,$orderBy = 'desc');
    public function getById($id);
    public function getFullById($id);
    public function filterOfTeacher($teacher_id ,$value, $offset = 10, $orderBy = 'desc');
    public function update($id, $collection = []);
    public function delete($id);
    public function getDataAcceptForDate($date);
    public function getDataDenyAndLack($start_date, $end_date);
    public function getResultForRegistration($id);
    public function setStatus($id, $status = 0);
    public function checkTime($start_time, $end_time, $date, $room_id);

}