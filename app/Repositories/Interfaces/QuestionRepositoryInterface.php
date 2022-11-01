<?php

namespace App\Repositories\Interfaces;

interface QuestionRepositoryInterface{

    public function getAll($offset = 10);
    public function getById($id);
}