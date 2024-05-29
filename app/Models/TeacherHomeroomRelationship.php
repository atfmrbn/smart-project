<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherHomeroomRelationship extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function studentTeacherHomeroomRelationship()
    {
        return $this->hasMany(StudentTeacherHomeroomRelationship::class);
    }
}
