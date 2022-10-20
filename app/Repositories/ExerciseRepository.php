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

    public function create($collection = [])
    {
        return $this->exercise->create([
            'topic_id' => $collection['topic_id'],
            'name' => $collection['name'],
            'content' => $collection['content'],
            'assignment_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'expiration_date' => date('Y-m-d H:i:s', strtotime($collection['expiration_date'])),
        ]);
    }

}