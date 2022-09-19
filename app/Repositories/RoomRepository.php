<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RoomRepository implements RoomRepositoryInterface{

    private $room;

    public function __construct(Room $room)
    {
        $this->room = $room;
    }
    
    public function getDropDown()
    {
        return $this->room->select('id', 'name', 'capacity')->orderBy('capacity', 'asc')->get();
    }

    public function getDropDownAsc()
    {
        return $this->room->select('id', 'name', 'capacity')->orderBy('id', 'asc')->get();
    }


    
}