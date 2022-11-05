<?php

namespace App\Repositories;

use App\Models\Quiz;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuizRepository implements QuizRepositoryInterface{

    protected $quiz;

    public function __construct(
        Quiz $quiz
    )
    {
        $this->quiz = $quiz;
    }

    public function create($collection = [])
    {
        return $this->quiz->create([
            'name' => $collection['name'],
            'topic_id' => $collection['topic_id'],
            'subject_id' => $collection['subject_id'],
            'duration' => $collection['duration'],
            'start_time' => date('Y-m-d H:i:s', strtotime($collection['start_time'])),
            'end_time' => date('Y-m-d H:i:s', strtotime($collection['end_time'])),
            'password' => $collection['password'],
            'is_show' => $collection['is_show'] ?? 0,
        ]);
    }
}