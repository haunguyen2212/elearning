<?php

namespace App\Repositories;

use App\Models\Notice;
use App\Repositories\Interfaces\NoticeRepositoryInterface;

class NoticeRepository implements NoticeRepositoryInterface{

    private $notice;

    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }

    public function getAll()
    {
        return $this->notice->where('is_show', '1')->get();
    }
}