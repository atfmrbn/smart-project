<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class GradeDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'grade_id',
        'student_id',
        'value',
    ];

    /**
     * Define relationships
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public static function getGradeDetail($curriculumId, $studentId)
    {
        $sql = "SELECT 
s.name as subject_name, ceiling(sum(gd.`value`* g.percentage/100)) AS total_grade_value,average_thr.average_grade_value
FROM grade_details AS gd
INNER JOIN grades AS g ON g.id=gd.grade_id
INNER JOIN teacher_classroom_relationships AS tcr ON tcr.id = g.teacher_classroom_relationship_id
INNER JOIN teacher_homeroom_relationships AS thr ON thr.id=tcr.teacher_homeroom_relationship_id
INNER JOIN teacher_subject_relationships AS tsr ON tsr.id=tcr.teacher_subject_relationship_id
INNER JOIN subjects AS s ON s.id=tsr.subject_id
INNER JOIN 
(SELECT s.id AS subject_id,thr.id AS thr_id,
ceiling((sum(gd.`value`* g.percentage/100))/thr.student_count) AS average_grade_value 
FROM grade_details AS gd
INNER JOIN grades AS g ON g.id=gd.grade_id
INNER JOIN teacher_classroom_relationships AS tcr ON tcr.id = g.teacher_classroom_relationship_id
INNER JOIN 
(SELECT thr.*, COUNT(sthr.id) AS student_count FROM teacher_homeroom_relationships AS thr
INNER JOIN student_teacher_homeroom_relationships AS sthr ON thr.id=sthr.teacher_homeroom_relationship_id
WHERE thr.curriculum_id=$curriculumId AND thr.deleted_at IS NULL and sthr.deleted_at IS NULL
GROUP BY thr.id) AS thr ON thr.id=tcr.teacher_homeroom_relationship_id
INNER JOIN teacher_subject_relationships AS tsr ON tsr.id=tcr.teacher_subject_relationship_id
INNER JOIN subjects AS s ON s.id=tsr.subject_id
WHERE thr.curriculum_id=2 AND gd.deleted_at IS NULL 
GROUP BY s.id,thr.id, thr.student_count) AS average_thr
ON thr.id=average_thr.thr_id AND s.id=average_thr.subject_id
 WHERE thr.curriculum_id=$curriculumId AND gd.student_id=$studentId AND gd.deleted_at IS NULL 
 GROUP BY gd.student_id, s.id, average_thr.average_grade_value";

        return DB::select($sql);
    }
}
