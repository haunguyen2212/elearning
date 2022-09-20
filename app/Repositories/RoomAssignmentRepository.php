<?php

namespace App\Repositories;

use App\Models\RoomAssignment;
use App\Repositories\Interfaces\RoomAssignmentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RoomAssignmentRepository implements RoomAssignmentRepositoryInterface{

    protected $roomAssignment;

    public function __construct(
        RoomAssignment $roomAssignment
    )
    {
        $this->roomAssignment = $roomAssignment;
    }

    public function getById($id)
    {
        return $this->roomAssignment->find($id);
    }

    public function getFullById($id)
    {
        return $this->roomAssignment->join('room_registrations', 'registration_id', '=', 'room_registrations.id')
            ->leftJoin('teachers', 'teacher_id', '=', 'teachers.id')
            ->where('room_assignments.id', $id)
            ->select('room_assignments.*', 'purpose', 'date', 'teacher_id', 'start_time', 'end_time', 'amount', 'status' ,DB::raw('room_registrations.id as registration_id, teachers.name as teacher_name'))
            ->first();
    }

    public function setNullRoom($id)
    {
        return $this->roomAssignment->where('id', $id)->update([
            'room_id' => NULL,
        ]);
    }

    public function countRegistration($registration_id)
    {
        return $this->roomAssignment->where('registration_id', $registration_id)->count();
    }

    public function create($collection = [])
    {
        return $this->roomAssignment->create([
            'registration_id' => $collection['registration_id'],
            'room_id' => $collection['room_id'],
        ]);
    }

    public function update($id, $collection = [])
    {
        return $this->roomAssignment->find($id)->update([
            'room_id' => $collection['room_id'] ?? NULL,
        ]);
    }

    public function delete($id)
    {
        return $this->roomAssignment->find($id)->delete();
    }

    public function deleteByRegistration($registration_id)
    {
        return $this->roomAssignment->where('registration_id', $registration_id)->delete();
    }

}