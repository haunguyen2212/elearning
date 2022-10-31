<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'question',
        'image',
        'correct_answer',
        'answer_a',
        'answer_b',
        'answer_c',
        'answer_d',
        'explain',
        'level',
        'teacher_id',
        'shared',
    ];
}
