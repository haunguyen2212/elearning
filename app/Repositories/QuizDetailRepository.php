<?php

namespace App\Repositories;

use App\Models\QuizDetail;
use App\Repositories\Interfaces\QuizDetailRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuizDetailRepository implements QuizDetailRepositoryInterface{

    protected $quizDetail;

    public function __construct(
        QuizDetail $quizDetail
    )
    {
        $this->quizDetail = $quizDetail;
    }

    public function create($collection = [])
    {
        return $this->quizDetail->create([
            'quiz_id' => $collection['quiz_id'],
            'question_id' => $collection['question_id'],
        ]);
    }

    public function delete($id)
    {
        return $this->quizDetail->find($id)->delete();
    }

    public function deleteAll($quiz_id)
    {
        return $this->quizDetail->where('quiz_id', $quiz_id)->delete(); 
    }

    public function checkIssetQuestion($quiz_id, $question_id)
    {
        return $this->quizDetail->where('quiz_id', $quiz_id)->where('question_id', $question_id)->first();
    }
}