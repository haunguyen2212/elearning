<?php

namespace App\Repositories\Interfaces;

interface NotificationDetailRepositoryInterface{

    public function create($collection = []);
    public function watch($notification_id, $student_id);

}