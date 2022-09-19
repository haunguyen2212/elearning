<?php

namespace App\Repositories\Interfaces;

interface RoomAssignmentRepositoryInterface{

    public function getById($id);
    public function getFullById($id);
    public function setNullRoom($id);
    public function countRegistration($registration_id);
    public function create($collection = []);
    public function delete($id);
    public function update($id, $collection = []);

}