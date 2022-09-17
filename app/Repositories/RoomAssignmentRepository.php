<?php

namespace App\Repositories;

use App\Models\RoomAssignment;
use App\Repositories\Interfaces\RoomAssignmentRepositoryInterface;

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

    public function delete($id)
    {
        return $this->roomAssignment->find($id)->delete();
    }

}