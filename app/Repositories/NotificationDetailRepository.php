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

    public function watch($student_id)
    {
        return $this->notificationDetail->where('student_id', $student_id)
            ->where('watched', 0)
            ->update([
                'watched' => 1
            ]);
    }

    public function getAll($student_id, $offset = 10)
    {
        return $this->notificationDetail->join('notifications', 'notification_id', 'notifications.id')
            ->where('student_id', $student_id)
            ->select('notifications.*', 'watched')
            ->orderBy('watched', 'asc')
            ->orderBy('time', 'desc')
            ->paginate($offset);
    }
}