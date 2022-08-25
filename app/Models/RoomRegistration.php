<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRegistration extends Model
{
    use HasFactory;

    protected $table = 'room_registrations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'purpose',
        'teacher_id',
        'date',
        'start_time',
        'end_time',
        'amount',
    ];
}
