<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'teacher_id',
        'introduce',
        'is_enrol',
        'is_show',
        'code',
        'notice',
    ];
}
