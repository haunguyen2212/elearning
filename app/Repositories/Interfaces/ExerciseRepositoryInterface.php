<?php

namespace App\Repositories\Interfaces;

interface ExerciseRepositoryInterface{

    public function getAll($topic_id);
    public function getActive($topic_id);
    public function getById($id);
    public function create($collection = []);
    public function hide($id);
    public function show($id);
    public function update($collection = [], $id);
    public function delete($id);
    public function getScoreStudent($id, $student_id);

}