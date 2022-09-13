<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAssignment extends Model
{
    use HasFactory;

    protected $table = 'room_assignments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'registration_id',
        'room_id',
    ];
}
