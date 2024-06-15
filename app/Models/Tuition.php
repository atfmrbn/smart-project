<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function tuitionType()
    {
        return $this->belongsTo(TuitionType::class);
    }
}
