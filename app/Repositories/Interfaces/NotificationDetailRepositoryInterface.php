<?php

namespace App\Repositories\Interfaces;

interface NotificationDetailRepositoryInterface{

    public function create($collection = []);
    public function watch($student_id);
    public function getAll($student_id, $offset = 10);

}