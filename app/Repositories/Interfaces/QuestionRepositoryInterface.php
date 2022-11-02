<?php

namespace App\Repositories\Interfaces;

interface QuestionRepositoryInterface{

    public function getAll($search = [], $offset = 10);
    public function getById($id);
}