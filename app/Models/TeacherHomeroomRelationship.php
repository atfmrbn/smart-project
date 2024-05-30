<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherHomeroomRelationship extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'classroom_id',
        'curriculum_id',
    ];

    protected $table = 'teacher_homeroom_relationships';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }

    public function studentTeacherHomeroomRelationship()
    {
        return $this->hasMany(StudentTeacherHomeroomRelationship::class);
    }
}
