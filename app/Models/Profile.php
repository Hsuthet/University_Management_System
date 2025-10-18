<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // 👇 Add this property if it's missing
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'department',
        'academic_year',
        'phone',
        'age',
        'father_name',
        'gender',
        'nrc',
        'profile_image'
    ];

    // If you have hidden attributes
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
