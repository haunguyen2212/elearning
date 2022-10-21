<?php

namespace App\Repositories\Interfaces;

interface ExerciseDocumentRepositoryInterface{

    public function getAll($exercise_id);
    public function getActive($exercise_id);
    public function getById($id);
    public function create($collection = []);

}