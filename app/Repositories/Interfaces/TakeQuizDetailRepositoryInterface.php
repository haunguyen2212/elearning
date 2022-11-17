<?php

namespace App\Repositories\Interfaces;

interface TakeQuizDetailRepositoryInterface{

    public function create($collection = []);
    public function chooseAnswer($take_quiz_id, $question_id ,$answer);

}