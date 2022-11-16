<?php

namespace App\Repositories;

use App\Models\TakeQuizDetail;
use App\Repositories\Interfaces\TakeQuizDetailRepositoryInterface;

class TakeQuizDetailRepository implements TakeQuizDetailRepositoryInterface{

    protected $takeQuizDetail;

    public function __construct(
        TakeQuizDetail $takeQuizDetail
    )
    {
        $this->takeQuizDetail = $takeQuizDetail;
    }

    public function create($collection = []){
        return $this->takeQuizDetail->create([
            'take_quiz_id' => $collection['take_quiz_id'],
            'question_id' => $collection['question_id'],
            'choose' => NULL,
            'correct' => $collection['correct'],
        ]);
    }
}