<?php

namespace App\Repositories\Interfaces;

interface TopicDocumentRepositoryInterface{

    public function getAll($course_id, $orderBy = 'asc');
    public function getActive($course_id, $orderBy = 'asc');
    public function create($collection = []);
    public function getById($id);
    public function show($id);
    public function hide($id);
    public function getTopic($id);
    public function getCourse($id);
    public function delete($id);

}