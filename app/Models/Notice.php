<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    protected $appends = ['notice_image'];
 
public function getNoticeImageAttribute()
{
    if (!$this->attributes['notice_image']) {
        return null;
    }
 
    return asset('storage/' . $this->attributes['notice_image']);
}
     protected $fillable = [
        'event_name',
        'description',
        'date',
        'location',
        'notice_image',
        'academic_year_id',
        'department_id',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
