<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';
    protected $primaryKey = 'id';
    protected $fillable = [
        'course_id',
        'title',
        'content',
        'is_show',
        'pin',
    ];
}
