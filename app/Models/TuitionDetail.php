<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TuitionDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function tuitionType()
    {
        return $this->belongsTo(TuitionType::class);
    }

    public function tuition()
    {
        return $this->belongsTo(Tuition::class);
    }
}
