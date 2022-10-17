<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseDocument extends Model
{
    use HasFactory;

    protected $table = 'exercise_documents';
    protected $primaryKey = 'id';
    protected $fillable = [
        'exercise_id',
        'name',
        'link',
        'is_show',
    ];
}
