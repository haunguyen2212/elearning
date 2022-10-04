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
        return $this->topic->where('course_id', $course_id)->orderBy('pin', 'desc')->orderBy('created_at', 'desc')->orderBy('id', $orderBy)->get();
    }

    public function getActive($course_id, $orderBy = 'asc')
    {
        return $this->topic->where('course_id', $course_id)->where('is_show', 1)->orderBy('pin', 'desc')->orderBy('created_at', 'desc')->orderBy('id', $orderBy)->get();
    }

    public function pin($id)
    {
        return $this->topic->find($id)->update([
            'pin' => 1,
        ]);
    }

    public function unpin($id)
    {
        return $this->topic->find($id)->update([
            'pin' => 0,
        ]);
    }

    public function show($id)
    {
        return $this->topic->find($id)->update([
            'is_show' => 1,
        ]);
    }

    public function hide($id)
    {
        return $this->topic->find($id)->update([
            'is_show' => 0,
        ]);
    }
}