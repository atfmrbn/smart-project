<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tuition extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function studentTeacherHomeroomRelationship()
    {
        return $this->belongsTo(StudentTeacherHomeroomRelationship::class, 'student_teacher_homeroom_relationship_id');
    }
    
    public function tuitionDetails()
    {
        return $this->hasMany(TuitionDetail::class);
    }
}
