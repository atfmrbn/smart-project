<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'task_type_id',
        'student_teacher_homeroom_relationship_id',
        'value'
    ];

    /**
     * Define relationships
     */

    public function taskType()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function studentTeacherHomeroomRelationship()
    {
        return $this->belongsTo(StudentTeacherHomeroomRelationship::class, 'student_teacher_homeroom_relationship_id');
    }
}
