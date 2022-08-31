<?php

namespace App\Repositories\Interfaces;

interface NoticeRepositoryInterface{

    public function getAll();
    public function getAllNotice($offset = 10);
    public function delete($id);
    public function getById($id);
    public function create($collection = []);
}