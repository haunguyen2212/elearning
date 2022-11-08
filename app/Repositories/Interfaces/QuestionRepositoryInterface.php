<?php

namespace App\Repositories\Interfaces;

interface QuestionRepositoryInterface{

    public function getAll($search = [], $offset = 10);
    public function getById($id);
    public function getFullById($id);
    public function create($collection = []);
    public function update($id, $collection);
    public function delete($id);
    public function getAllQuestionCanUse($quiz_id, $subject_id, $teacher_id);
}