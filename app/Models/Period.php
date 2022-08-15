<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table = 'periods';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
    ];
}
