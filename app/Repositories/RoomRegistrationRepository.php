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
        return $this->room_registration->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->whereDate('date', $date)
            ->select('room_registrations.id', 'purpose', 'start_time', 'end_time', 'amount', DB::raw('teachers.name as teacher_name'))
            ->orderBy('end_time', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function create($collection = [], $is_admin = false)
    {
        if($is_admin){
            return $this->room_registration->create([
                'purpose' => $collection['purpose'],
                'teacher_id' => $collection['teacher_id'],
                'amount' => $collection['amount'],
                'date' => $collection['date'],
                'start_time' => $collection['start_time'],
                'end_time' => $collection['end_time'],
            ]);
        }
        else{
            return $this->room_registration->create([
                'purpose' => $collection['purpose'],
                'teacher_id' => auth()->guard('teacher')->id(),
                'amount' => $collection['amount'],
                'date' => $collection['date'],
                'start_time' => $collection['start_time'],
                'end_time' => $collection['end_time'],
            ]);
        }
    }

    public function getOfTeacher($teacher_id, $offset = 10 ,$orderBy = 'desc')
    {
        return $this->room_registration->where('teacher_id', $teacher_id)->orderBy('date', $orderBy)->paginate($offset);
    }

    public function delete($id)
    {
        return $this->room_registration->find($id)->delete();
    }
    
}