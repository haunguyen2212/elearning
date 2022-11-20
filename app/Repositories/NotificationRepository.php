<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use Carbon\Carbon;

class NotificationRepository implements NotificationRepositoryInterface{

    protected $notification;

    public function __construct(
        Notification $notification
    )
    {
        $this->notification = $notification;
    }

    public function create($collection = [])
    {
        return $this->notification->create([
            'content' => $collection['content'],
            'link' => $collection['link'],
            'time' => Carbon::now()->format('Y-m-d H:i:s'),
            'active' => $collection['active'] ?? '0',
        ]);
    }

    public function getById($id)
    {
        return $this->notification->find($id);
    }

    public function updateStatus($id, $status)
    {
        return $this->notification->find($id)->update([
            'active' => $status,
        ]);
    }

}