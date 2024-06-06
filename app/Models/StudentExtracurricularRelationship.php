<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExtracurricularRelationship extends Model
{
    use HasFactory;

    // protected $table = 'users';

    protected $fillable = [
        'student_id',
        'extracurricular_id',
        'admin_id',
        'description',
    ];


    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class, 'extracurricular_id');
    }

    // public static function getActiveExtracurricularStudent($curriculumId){
    //     return self::select('users.*', 'teacher_homeroom_relationships.classroom_id', 'users.identity_number')
    //         ->where('role', 'Student')
    //         ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
    //         ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
    //         ->join('classrooms', 'classrooms.id', '=', 'teacher_homeroom_relationships.classroom_id')
    //         ->where('teacher_homeroom_relationships.curriculum_id', $curriculumId)
    //         // ->orderBy('users.name')
    //         ->get();
    // }

    // public static function getInactiveExtracurricularStudent($curriculumId){
    //     return self::select('users.*', 'teacher_homeroom_relationships.classroom_id', 'users.identity_number')
    //         ->where('role', 'Student')
    //         ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
    //         ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
    //         ->join('classrooms', 'classrooms.id', '=', 'teacher_homeroom_relationships.classroom_id')
    //         ->where('teacher_homeroom_relationships.curriculum_id', $curriculumId)
    //         ->orderBy('users.name')
    //         ->get();
    // }
}
