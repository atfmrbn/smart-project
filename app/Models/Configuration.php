<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends Model
{
    use HasFactory;
    use SoftDeletes;    

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'book_penalty',
    ];
    protected $guarded = [];
    public $timestamps = false;
}
