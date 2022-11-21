<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationDetail extends Model
{
    use HasFactory;

    protected $table = 'notification_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'notification_id',
        'student_id',
        'watched',
    ];
}
