<?php

namespace App\Repositories\Interfaces;

interface RoomRepositoryInterface{

    public function getDropDown();
    public function getDropDownAsc();
    public function getDropDownForCapacity($capacity);
    public function checkCapacity($id, $capacity);
    public function getAll($offset = 10);
    public function delete($id);
    public function getById($id);
    public function update($id, $collection = []);
    public function create($collection = []);
    public function getByKey($key, $offset = 10);

}