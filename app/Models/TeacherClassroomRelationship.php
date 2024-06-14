<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TeacherSubjectRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherClassroomRelationship extends Model
{
    use HasFactory;
    use SoftDeletes;    

    protected $fillable = [
        'teacher_homeroom_relationship_id',
        'teacher_subject_relationship_id',
    ];

    protected $guarded = [];

    public function teacherHomeroomRelationship()
    {
        return $this->belongsTo(TeacherHomeroomRelationship::class, 'teacher_homeroom_relationship_id');
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
