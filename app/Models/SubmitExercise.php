<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitExercise extends Model
{
    use HasFactory;

    protected $table = 'submit_exercise';
    protected $primaryKey = 'id';
    protected $fillable = [
        'exercise_id',
        'student_id',
        'link',
    ];
}
