<?php

namespace App\Repositories\Interfaces;

interface QuizDetailRepositoryInterface{

    public function create($collection = []);
    public function delete($id);
    public function deleteAll($quiz_id);
    public function checkIssetQuestion($quiz_id, $question_id);
}