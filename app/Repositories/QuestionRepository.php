<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\Interfaces\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface{

    protected $question;

    public function __construct(
        Question $question
    )
    {
        $this->question = $question;
    }

    public function getAll($offset = 10)
    {
        return $this->question->paginate($offset);
    }

    public function getById($id)
    {
        return $this->question->where('id', $id)->first();
    }

}