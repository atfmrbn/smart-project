<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;    

    protected $guarded = [];

    public function teacherClassroomRelationship()
    {
        return $this->belongsTo(TeacherClassroomRelationship::class);
    }
}
