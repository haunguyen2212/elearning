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

    public function hide($id)
    {
        return $this->exercise->find($id)->update([
            'is_show' => 0,
        ]);
    }

    public function show($id)
    {
        return $this->exercise->find($id)->update([
            'is_show' => 1,
        ]);
    }

    public function update($collection = [], $id)
    {
        return $this->exercise->find($id)->update([
            'name' => $collection['name'],
            'expiration_date' => date('Y-m-d H:i:s', strtotime($collection['expiration_date'])),
            'content' => $collection['content'],
        ]);
    }

    public function delete($id)
    {
        return $this->exercise->find($id)->delete();
    }

    public function getScoreStudent($id, $student_id)
    {
        return $this->exercise->leftJoin('exercise_score', 'exercise_id', 'exercises.id')
            ->where('exercise_id', $id)
            ->where('student_id', $student_id)
            ->first();
    }
}