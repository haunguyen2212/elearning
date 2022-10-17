<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $table = 'exercises';
    protected $primaryKey = 'id';
    protected $fillable = [
        'topic_id',
        'name',
        'content',
        'assignment_date',
        'expiration_date',
        'is_show',
    ];
}
