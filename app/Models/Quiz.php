<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'teacher_id',
        'topic_id',
        'subject_id',
        'start_time',
        'end_time',
        'duration',
        'password',
        'is_show',
        'maximum',
    ];
}
