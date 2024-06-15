<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
