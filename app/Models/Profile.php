<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
     /**
     * Get dummy user profile data
     *
     * @return array
     */
   protected $fillable = [
        'name', 'email', 'role', 'department', 'academic_year',
        'phone', 'age', 'father_name', 'gender', 'nrc'
    ];

    public static function getDummyProfile()
    {
        return [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'role' => 'Student',
            'department' => 'Computer Science',
            'academic_year' => '2025 - Semester 1',
            'phone' => '0912345678',
            'age' => 21,
            'father_name' => 'Robert Doe',
            'gender' => 'Male',
            'nrc' => '12/ABC(N)123456'
        ];
    }
}
