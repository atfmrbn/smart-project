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
        'teacher_subject_relationship_id',
        'schedule_day',
        'schedule_time_start',
        'schedule_time_end', 
    ];

    protected $guarded = [];

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
        return $this->belongsTo(TeacherSubjectRelationship::class);
    }

    public function teacherSubject()
    {
        return $this->TeacherSubjectRelationship->teacher->name . ' - ' . $this->TeacherSubjectRelationship->subject->name;
    }
}
