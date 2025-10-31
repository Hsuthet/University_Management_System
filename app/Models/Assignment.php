<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $appends = ['assignment_file'];
 
public function getAssignmentFileAttribute()
{
    if (!$this->attributes['assignment_file']) {
        return null;
    }
 
    return asset('storage/' . $this->attributes['assignment_file']);
}
     protected $fillable = [
        'name',
        'department_id',
        'deadline',
        'assignment_file',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
