<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseScore extends Model
{
    use HasFactory;

    protected $table = 'exercise_score';
    protected $primaryKey = 'id';
    protected $fillable = [
        'exercise_id',
        'student_id',
        'score',
    ];
}
