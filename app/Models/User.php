<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = ['profile_image'];
 
public function getProfileImageAttribute()
{
    if (!isset($this->attributes['profile_image']) || !$this->attributes['profile_image']) {
        return null;
    }

    return asset('storage/' . $this->attributes['profile_image']);
}

    protected $fillable = [
        'name',
        'email',
         'role',
        'department_id',
        'phone_number',
        'academic_year_id',
        'age',
        'address',
        'roll_number',
        'father_name',
        'password',
        'gender',
        'nrc',
        'profile_image'
    ];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'age',
    ];

     public function department() {
        return $this->belongsTo(Department::class);
    }

    public function academicYear() {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogs()
{
    return $this->hasMany(Blog::class);
}

}
