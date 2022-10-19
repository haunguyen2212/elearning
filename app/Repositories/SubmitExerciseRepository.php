<?php

namespace App\Repositories;

use App\Models\SubmitExercise;
use App\Repositories\Interfaces\SubmitExerciseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SubmitExerciseRepository implements SubmitExerciseRepositoryInterface{

    protected $submitExercise;

    public function __construct(
        SubmitExercise $submitExercise
    )
    {
        $this->submitExercise = $submitExercise;
    }

    public function getAll($exercise_id, $student_id)
    {
        return $this->submitExercise->where('exercise_id', $exercise_id)->where('student_id', $student_id)->get();
    }

    public function create($collection = [])
    {
        return $this->submitExercise->create([
            'exercise_id' => $collection['exercise_id'],
            'student_id' => $collection['student_id'],
            'link' => $collection['link'],
        ]);
    }

    public function delete($id)
    {
        return $this->submitExercise->find($id)->delete();
    }

    public function getById($id)
    {
        return $this->submitExercise->find($id);
    }

}