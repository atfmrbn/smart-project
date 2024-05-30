<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingBookDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function calculatePenalty()
    {
        if (!$this->returned_date || !$this->due_date) {
            return 0;
        }

        $dueDate = Carbon::parse($this->due_date);
        $returnedDate = Carbon::parse($this->returned_date);
        $daysLate = $dueDate->diffInDays($returnedDate, false); 

        if ($daysLate <= 0) {
            return 0;
        }

        // penalty untuk telat pengembalian satu hari
        $penalty = 20000;

        // penambahan penalty jika telat lebih dari satu hari
        if ($daysLate > 1) {
            $penalty += ($daysLate - 1) * 2000;
        }

        return $penalty;
    }
}
