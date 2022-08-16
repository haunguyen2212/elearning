<?php

namespace App\Repositories;

use App\Models\RoomRegistration;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;

class RoomRegistrationRepository implements RoomRegistrationRepositoryInterface{

    private $room_registration;

    public function __construct(RoomRegistration $room_registration)
    {
        $this->room_registration = $room_registration;
    }

    public function getForDate($date)
    {
        return $this->room_registration->whereDate('date', $date)
            ->select('id', 'purpose', 'teacher_id', 'period_start_id', 'period_end_id', 'amount')
            ->orderBy('period_end_id', 'asc')
            ->orderBy('period_start_id', 'asc')
            ->get();
    }

    
}