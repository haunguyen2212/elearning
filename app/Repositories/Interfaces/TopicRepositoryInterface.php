<?php

namespace App\Repositories\Interfaces;

interface TopicRepositoryInterface{

    public function getAll($course_id, $orderBy = 'asc');
    public function getActive($course_id, $orderBy = 'asc');
    public function pin($id);
    public function unpin($id);
    public function show($id);
    public function hide($id);
    public function create($collection = []);
    public function getCourse($id);
    public function getAllDocument($id);
    public function getById($id);
    public function update($id, $collection = []);
    public function delete($id);

}