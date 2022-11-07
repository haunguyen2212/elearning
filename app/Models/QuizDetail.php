<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizDetail extends Model
{
    use HasFactory;

    protected $table = 'quiz_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'quiz_id',
        'question_id',
    ];
}
