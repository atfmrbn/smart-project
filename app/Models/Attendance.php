<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_teacher_homeroom_id',
        'attendance_date',
        'note',
        'status'
    ];

    public function studentTeacherHomeroomRelationship()
    {
        return $this->belongsTo(StudentTeacherHomeroomRelationship::class, 'student_teacher_homeroom_id');
    }
}