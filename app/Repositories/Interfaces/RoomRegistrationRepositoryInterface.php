<?php

namespace App\Repositories\Interfaces;

interface RoomRegistrationRepositoryInterface{

    public function getAll($offset = 10);
    public function getForDate($date);

}