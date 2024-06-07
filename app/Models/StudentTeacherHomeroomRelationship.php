<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TeacherHomeroomRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentTeacherHomeroomRelationship extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
      'student_id',
      'teacher_homeroom_relationship_id',
      'teacher_id',
      'classroom_id'
  ];
    protected $guarded = [];

    public function student()
    {
      return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
      return $this->belongsTo(User::class, 'teacher_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function teacherHomeroomRelationship()
    {
        return $this->belongsTo(TeacherHomeroomRelationship::class, 'teacher_homeroom_relationship_id');
    }
}
