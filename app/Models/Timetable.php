<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;
     protected $fillable = [
        'department_id',
        'academic_year_id',
        'teacher',
        'day',
        'start_time',
        'end_time'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function academicYear() {
        return $this->belongsTo(AcademicYear::class);
    }

}
