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

    // Relasi dengan model User sebagai siswa
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function taskType()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function studentTeacherHomeroomRelationship()
    {
    return $this->belongsTo(StudentTeacherHomeroomRelationship::class);
    }

}
