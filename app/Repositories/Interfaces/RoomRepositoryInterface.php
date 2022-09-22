<?php

namespace App\Repositories\Interfaces;

interface RoomRepositoryInterface{

    public function getDropDown();
    public function getDropDownAsc();
    public function getDropDownForCapacity($capacity);
    public function checkCapacity($id, $capacity);

}