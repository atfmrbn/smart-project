<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TeacherSubjectRelationship;

class TeacherClassroomRelationship extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'classroom_id',
        'curriculum_id',
        'subject_id',
    ];

    protected $table = 'teacher_classroom_relationships';
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function teacherSubjectRelationship()
    {
        return $this->belongsTo(TeacherSubjectRelationship::class, 'subject_id');
    }
}
