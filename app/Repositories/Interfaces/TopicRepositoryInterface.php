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

}