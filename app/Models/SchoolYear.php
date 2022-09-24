<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    protected $table = 'school_years';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'status',
    ];
}
