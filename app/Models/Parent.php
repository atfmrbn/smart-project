<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class parents extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'parent_name',
        'gender',
        'parent_email',
        'nik',
        'address',
        'phone',
        // 'born_date',
    ];

    public function user()
    {
        $user = Auth::user();
        $parent = $user->parents;

        return view('dashboard', compact('user','parents'));
    }
}
