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
        'status',
        'teacher_id'
    ];

    public function student()
    {
      return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    public function studentTeacherHomeroomRelationship()
    {
        return $this->belongsTo(StudentTeacherHomeroomRelationship::class, 'student_teacher_homeroom_id');
    }
}