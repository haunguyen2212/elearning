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

    public function getDropDownForCapacity($capacity)
    {
        return $this->room->where('capacity', '>=', $capacity)->select('id', 'name', 'capacity')->orderBy('id', 'asc')->get();
    }

    public function checkCapacity($id, $capacity)
    {
        return $this->room->where('id', $id)->where('capacity', '>=', $capacity)->count() > 0;
    }

    public function getAll($offset = 10)
    {
        return $this->room->paginate($offset);
    }

    public function delete($id)
    {
        return $this->room->find($id)->delete();
    }

    public function getById($id)
    {
        return $this->room->find($id);
    }

    public function update($id, $collection = [])
    {
        return $this->room->find($id)->update([
            'name' => $collection['name'],
            'capacity' => $collection['capacity'],
        ]);
    }

    public function create($collection = [])
    {
        return $this->room->create([
            'name' => $collection['name'],
            'capacity' => $collection['capacity'],
        ]);
    }
    
    public function getByKey($key, $offset = 10)
    {
        return $this->room->where('name', 'like', '%'.$key.'%')->paginate($offset);
    }
}