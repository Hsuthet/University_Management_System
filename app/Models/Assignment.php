<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
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
