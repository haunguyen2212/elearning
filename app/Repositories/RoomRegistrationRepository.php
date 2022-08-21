<?php

namespace App\Repositories;

use App\Models\RoomRegistration;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RoomRegistrationRepository implements RoomRegistrationRepositoryInterface{

    private $room_registration;

    public function __construct(RoomRegistration $room_registration)
    {
        $this->room_registration = $room_registration;
    }

    public function getAll($offset = 10)
    {
        return $this->room_registration->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->select('room_registrations.*', DB::raw('teachers.name as teacher_name'))
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'asc')
            ->paginate($offset);
    }

    public function getForDate($date)
    {
        return $this->room_registration->whereDate('date', $date)
            ->select('id', 'purpose', 'teacher_id', 'start_time', 'end_time', 'amount')
            ->orderBy('end_time', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
    }

    
}