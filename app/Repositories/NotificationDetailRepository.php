<?php

namespace App\Repositories;

use App\Models\NotificationDetail;
use App\Repositories\Interfaces\NotificationDetailRepositoryInterface;
use Carbon\Carbon;

class NotificationDetailRepository implements NotificationDetailRepositoryInterface{

    protected $notificationDetail;

    public function __construct(
        NotificationDetail $notificationDetail
    )
    {
        $this->notificationDetail = $notificationDetail;
    }

    public function create($collection = [])
    {
        return $this->notificationDetail->create([
            'notification_id' => $collection['notification_id'],
            'student_id' => $collection['student_id'],
            'watched' => $collection['watched'] ?? '0',
        ]);
    }

    public function watch($notification_id, $student_id)
    {
        return $this->notificationDetail->where('notification_id', $notification_id)
            ->where('student_id', $student_id)
            ->update([
                'watched' => 1
            ]);
    }
}