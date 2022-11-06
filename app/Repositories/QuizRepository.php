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

    public function getAll($topic_id)
    {
        return $this->quiz->where('topic_id', $topic_id)->get();
    }

    public function getActive($topic_id)
    {
        return $this->quiz->where('topic_id', $topic_id)->where('is_show', 1)->get();
    }

    public function getById($id)
    {
        return $this->quiz->find($id);
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
            'maximum' => $collection['maximum'] ?? 1,
        ]);
    }

    public function delete($id)
    {
        return $this->quiz->find($id)->delete();
    }

    public function hide($id)
    {
        return $this->quiz->find($id)->update([
            'is_show' => 0,
        ]);
    }

    public function show($id)
    {
        return $this->quiz->find($id)->update([
            'is_show' => 1,
        ]);
    }

    public function update($id, $collection = [])
    {
        return $this->quiz->find($id)->update([
            'name' => $collection['name'],
            'duration' => $collection['duration'],
            'start_time' => date('Y-m-d H:i:s', strtotime($collection['start_time'])),
            'end_time' => date('Y-m-d H:i:s', strtotime($collection['end_time'])),
            'password' => $collection['password'],
            'maximum' => $collection['maximum'] ?? 1,
        ]);
    }
}