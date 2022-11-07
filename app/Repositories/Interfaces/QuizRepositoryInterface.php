<?php

namespace App\Repositories\Interfaces;

interface QuizRepositoryInterface{

    public function getAll($topic_id);
    public function getActive($topic_id);
    public function getById($id);
    public function create($collection = []);
    public function delete($id);
    public function hide($id);
    public function show($id);
    public function update($id, $collection = []);
    public function getAllQuestion($id);
}