<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentTeacherClassroomRelationship extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['student_id', 'teacher_classroom_relationship_id'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacherClassroomRelationship()
    {
        return $this->belongsTo(TeacherClassroomRelationship::class, 'teacher_classroom_relationship_id');
    }
    protected $guarded = [];
}
