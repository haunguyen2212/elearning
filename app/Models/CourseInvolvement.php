<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInvolvement extends Model
{
    use HasFactory;

    protected $table = 'course_involvement';
    protected $primaryKey = 'id';
    protected $fillable = [
        'course_id',
        'student_id',
    ];
}
