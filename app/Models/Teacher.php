<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'username',
        'name',
        'department_id',
        'gender',
        'date_of_birth',
        'address',
        'phone',
        'email',
        'password',
    ];
}
