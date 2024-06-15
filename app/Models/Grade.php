<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'task_type_id',
        'teacher_classroom_relationship_id',
        'percentage'
    ];

    /**
     * Define relationships
     */

    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function teacherClassroomRelationship()
    {
        return $this->belongsTo(TeacherClassroomRelationship::class);
    }
    
    public function gradeDetails()
    {
        return $this->hasMany(GradeDetail::class);
    }
}
