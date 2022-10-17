<?php

namespace App\Repositories;

use App\Models\Exercise;
use App\Repositories\Interfaces\ExerciseRepositoryInterface;
use Carbon\Carbon;

class ExerciseRepository implements ExerciseRepositoryInterface{

    protected $exercise;

    public function __construct(
        Exercise $exercise
    )
    {
        $this->exercise = $exercise;
    }

    public function getAll($topic_id)
    {
        return $this->exercise->where('topic_id', $topic_id)->get();
    }

    public function getActive($topic_id)
    {
        return $this->exercise->where('topic_id', $topic_id)->where('is_show', 1)->get();
    }

    public function getById($id)
    {
        return $this->exercise->find($id);
    }

}