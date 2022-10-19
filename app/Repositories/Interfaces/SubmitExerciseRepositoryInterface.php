<?php

namespace App\Repositories\Interfaces;

interface SubmitExerciseRepositoryInterface{

    public function getAll($exercise_id, $student_id);
    public function create($collection = []);
    public function delete($id);
    public function getById($id);
    
}
