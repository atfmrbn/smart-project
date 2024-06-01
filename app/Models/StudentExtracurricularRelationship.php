<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExtracurricularRelationship extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'name',
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
      return $this->belongsTo(Extracurricular::class);
    }
}
