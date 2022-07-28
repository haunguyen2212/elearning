<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'active',
    ];
}
