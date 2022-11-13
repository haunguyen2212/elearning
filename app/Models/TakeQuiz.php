<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakeQuiz extends Model
{
    use HasFactory;

    protected $table = 'take_quiz';
    protected $primaryKey = 'id';
    protected $fillable = [
        'quiz_id',
        'student_id',
        'start_time',
        'end_time',
        'submit_time',
        'score',
        'total',
        'number_correct',
    ];
}
