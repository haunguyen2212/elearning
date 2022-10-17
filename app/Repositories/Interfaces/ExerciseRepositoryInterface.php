<?php

namespace App\Repositories\Interfaces;

interface ExerciseRepositoryInterface{

    public function getAll($topic_id);
    public function getActive($topic_id);
    public function getById($id);

}