<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'identity_number',
        'parent_id',
        'name',
        'username',
        'password',
        'email',
        'gender',
        'born_date',
        'phone',
        'nik',
        'address',
        'role',
        'google_id',
        'image'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function parents()
    {
    return $this->hasMany(Parent::class);
    }

    public static function getActiveStudent($defaultCurriculumId)
    {
      return self::select('users.id', 'users.identity_number', 'users.name', 'classrooms.name as classroom_name')
            ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
            ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
            ->join('classrooms', 'classrooms.id', '=', 'teacher_homeroom_relationships.classroom_id')
            ->where('teacher_homeroom_relationships.curriculum_id', $defaultCurriculumId)
            ->get();
    }

    public function studentTeacherHomeroom()
    {
        return $this->hasOne(StudentTeacherHomeroomRelationship::class, 'student_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function attendances()
    {
        return $this->hasManyThrough(
            Attendance::class,
            StudentTeacherHomeroomRelationship::class,
            'student_id', // Foreign key on StudentTeacherHomeroom table
            'student_teacher_homeroom_id', // Foreign key on Attendance table
            'id', // Local key on User table
            'id' // Local key on StudentTeacherHomeroom table
        );
    }

    public function extracurriculars()
    {
        return $this->hasMany(StudentExtracurricularRelationship::class, 'student_id');
    }

    public function teacherHomeroomRelationships()
    {
        return $this->hasMany(TeacherHomeroomRelationship::class, 'teacher_id');
    }
}
