<?php

namespace App\Repositories;

use App\Models\TakeQuiz;
use App\Repositories\Interfaces\TakeQuizRepositoryInterface;
use Carbon\Carbon;

class TakeQuizRepository implements TakeQuizRepositoryInterface{

    protected $takeQuiz;

    public function __construct(
        TakeQuiz $takeQuiz
    )
    {
        $this->takeQuiz = $takeQuiz;
    }

    public function create($collection = [])
    {
        return $this->takeQuiz->create([
            'quiz_id' => $collection['quiz_id'],
            'student_id' => $collection['student_id'],
            'start_time' => date('Y-m-d H:i:s', strtotime($collection['start_time'])),
            'end_time' => date('Y-m-d H:i:s', strtotime($collection['end_time'])),
            'submit_time' => NULL,
            'score' => NULL,
            'total' => $collection['total'],
            'number_correct' => NULL,
        ]);
    }

    public function getById($id)
    {
        return $this->takeQuiz->find($id);
    }

    public function countTakeQuiz($quiz_id, $student_id)
    {
        return $this->takeQuiz->where('quiz_id', $quiz_id)->where('student_id', $student_id)->count();
    }

    public function getTakeQuiz($quiz_id, $student_id)
    {
        return $this->takeQuiz->where('quiz_id', $quiz_id)->where('student_id', $student_id)->get();
    }

    public function getQuestionOfTakeQuiz($id, $offset = 10)
    {
        return $this->takeQuiz->join('take_quiz_details', 'take_quiz_id', 'take_quiz.id')
            ->join('questions', 'question_id', 'questions.id')
            ->where('take_quiz.id', $id)
            ->select('questions.*', 'take_quiz_details.choose')
            ->orderBy('take_quiz_details.id', 'asc')
            ->paginate($offset);
    }

    public function getIdQuestionOfTakeQuiz($id)
    {
        return $this->takeQuiz->join('take_quiz_details', 'take_quiz_id', 'take_quiz.id')
            ->where('take_quiz.id', $id)
            ->select('take_quiz_details.*')
            ->orderBy('take_quiz_details.id', 'asc')
            ->get();
    }

    public function submitExam($id, $collection = [])
    {
        return $this->takeQuiz->find($id)->update([
            'score' => $collection['score'],
            'number_correct' => $collection['number_correct'],
            'submit_time' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}