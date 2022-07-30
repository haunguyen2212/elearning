<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeroomTeacher extends Model
{
    use HasFactory;

    protected $table = 'homeroom_teachers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'class_id',
        'teacher_id',
        'start_date',
        'end_date',
    ];
}
