<?php

namespace App\Repositories\Interfaces;

interface TopicDocumentRepositoryInterface{

    public function getAll($course_id, $orderBy = 'asc');
    public function getActive($course_id, $orderBy = 'asc');

}