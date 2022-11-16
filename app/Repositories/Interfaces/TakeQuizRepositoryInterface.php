<?php

namespace App\Repositories\Interfaces;

interface TakeQuizRepositoryInterface{

    public function create($collection = []);
    public function getById($id);
    public function countTakeQuiz($quiz_id, $student_id);
    public function getTakeQuiz($quiz_id, $student_id);
    public function getQuestionOfTakeQuiz($id, $offset = 10);
    public function getIdQuestionOfTakeQuiz($id);
}