<?php

namespace App\Repositories\Interfaces;

interface SubmitExerciseRepositoryInterface{

    public function getAll($exercise_id, $student_id);
    public function create($collection = []);
    
}
