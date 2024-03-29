<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classroom';
    protected $primaryKey = 'id';
    protected $fillable = [
        'class_id',
        'student_id',
    ];
}
