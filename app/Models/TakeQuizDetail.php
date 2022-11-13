<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakeQuizDetail extends Model
{
    use HasFactory;

    protected $table = 'take_quiz_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'take_quiz_id',
        'question_id',
        'choose',
        'correct',
    ];
}
