<?php

namespace App\Repositories;

use App\Models\TopicDocument;
use App\Repositories\Interfaces\TopicDocumentRepositoryInterface;

class TopicDocumentRepository implements TopicDocumentRepositoryInterface{

    private $topicDocument;

    public function __construct(TopicDocument $topicDocument)
    {
        $this->topicDocument = $topicDocument;
    }

    public function getAll($topic_id, $orderBy = 'asc')
    {
        return $this->topicDocument->where('topic_id', $topic_id)->orderBy('id', $orderBy)->get();
    }

    public function getActive($topic_id, $orderBy = 'asc')
    {
        return $this->topicDocument->where('topic_id', $topic_id)->where('is_show', 1)->orderBy('id', $orderBy)->get();
    }

    public function create($collection = [])
    {
        return $this->topicDocument->create([
            'topic_id' => $collection['topic_id'],
            'name' => $collection['name'],
            'link' => $collection['link'],
            'type' => $collection['type'],
            'is_show' => 1,
        ]);
    }

    public function getById($id)
    {
        return $this->topicDocument->find($id);
    }

    public function show($id)
    {
        return $this->topicDocument->find($id)->update([
            'is_show' => 1,
        ]);
    }

    public function hide($id)
    {
        return $this->topicDocument->find($id)->update([
            'is_show' => 0,
        ]);
    }

    public function getTopic($id)
    {
        return $this->topicDocument->join('topics', 'topic_id', 'topics.id')
            ->where('topic_documents.id', $id)
            ->select('topics.*')
            ->first();
    }

    public function getCourse($id)
    {
        return $this->topicDocument->join('topics', 'topic_id', 'topics.id')
            ->join('courses', 'course_id', 'courses.id')
            ->where('topic_documents.id', $id)
            ->select('courses.*')
            ->first();
    }

    public function delete($id)
    {
        return $this->topicDocument->find($id)->delete();
    }
}