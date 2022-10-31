<?php

namespace App\Repositories;

use App\Models\ExerciseScore;
use App\Repositories\Interfaces\ExerciseScoreRepositoryInterface;
use Carbon\Carbon;

class ExerciseScoreRepository implements ExerciseScoreRepositoryInterface{

    protected $exerciseScore;

    public function __construct(
        ExerciseScore $exerciseScore
    )
    {
        $this->exerciseScore = $exerciseScore;
    }

    public function getById($exercise_id, $student_id)
    {
        return $this->exerciseScore->where('exercise_id', $exercise_id)->where('student_id', $student_id)->first();
    }

    public function create($collection = [])
    {
        return $this->exerciseScore->create([
            'exercise_id' => $collection['exercise_id'],
            'student_id' => $collection['student_id'],
            'score' => $collection['score'],
        ]);
    }

    public function update($collection = [])
    {
        return $this->exerciseScore->where('exercise_id', $collection['exercise_id'])
            ->where('student_id', $collection['student_id'])
            ->update([
                'score' => $collection['score'],
            ]);
    }

    public function getScore($exercise_id, $student_id)
    {
        return $this->exerciseScore->where('exercise_id', $exercise_id)->where('student_id', $student_id)->first();
    }

}