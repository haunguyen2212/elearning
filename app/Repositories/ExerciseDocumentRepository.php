<?php

namespace App\Repositories;

use App\Models\ExerciseDocument;
use App\Repositories\Interfaces\ExerciseDocumentRepositoryInterface;

class ExerciseDocumentRepository implements ExerciseDocumentRepositoryInterface{

    protected $exerciseDocument;

    public function __construct(
        ExerciseDocument $exerciseDocumentRepository
    )
    {
        $this->exerciseDocument = $exerciseDocumentRepository;
    }

    public function getAll($exercise_id)
    {
        return $this->exerciseDocument->where('exercise_id', $exercise_id)->get();
    }

    public function getActive($exercise_id)
    {
        return $this->exerciseDocument->where('exercise_id', $exercise_id)->where('is_show', 1)->get();
    }

    public function getById($id)
    {
        return $this->exerciseDocument->find($id);
    }

    public function create($collection = [])
    {
        return $this->exerciseDocument->create([
            'exercise_id' => $collection['exercise_id'],
            'name' => $collection['name'],
            'link' => $collection['link'],
        ]);
    }

    public function delete($id)
    {
        return $this->exerciseDocument->find($id)->delete();
    }
}