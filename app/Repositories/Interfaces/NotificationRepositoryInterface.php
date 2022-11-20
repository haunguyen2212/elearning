<?php

namespace App\Repositories\Interfaces;

interface NotificationRepositoryInterface{

    public function create($collection = []);
    public function getById($id);
    public function updateStatus($id, $status);
}