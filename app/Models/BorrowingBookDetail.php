<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowingBookDetail extends Model
{
    use HasFactory;
    use SoftDeletes;    

    protected $guarded = [];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrowingBook()
    {
        return $this->belongsTo(BorrowingBook::class);
    }
}
