<?php

namespace App\Repositories;

use App\Models\Notice;
use App\Repositories\Interfaces\NoticeRepositoryInterface;
use Carbon\Carbon;

class NoticeRepository implements NoticeRepositoryInterface{

    private $notice;

    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }

    public function getAll()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return $this->notice->where('start_time', '<=', $now)->where('end_time', '>=', $now)->get();
    }
}