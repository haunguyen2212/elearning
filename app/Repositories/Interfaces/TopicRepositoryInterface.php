<?php

namespace App\Repositories\Interfaces;

interface TopicRepositoryInterface{

    public function getAll($course_id, $orderBy = 'asc');
    public function getActive($course_id, $orderBy = 'asc');

}