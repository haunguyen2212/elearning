<?php

namespace App\Repositories\Interfaces;

interface ExerciseScoreRepositoryInterface{

    public function getById($exercise_id, $student_id);
    public function create($collection = []);
    public function update($collection = []);

}