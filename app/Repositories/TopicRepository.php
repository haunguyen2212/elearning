<?php

namespace App\Repositories;

use App\Models\Topic;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TopicRepository implements TopicRepositoryInterface{

    private $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function getAll($course_id, $orderBy = 'asc')
    {
        return $this->topic->where('course_id', $course_id)->orderBy('id', $orderBy)->get();
    }

    public function getActive($course_id, $orderBy = 'asc')
    {
        return $this->topic->where('course_id', $course_id)->where('is_show', 1)->orderBy('id', $orderBy)->get();
    }
}