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
}