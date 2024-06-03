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

    public function borrowingBook()
    {
        return $this->belongsTo(BorrowingBook::class);
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

    public static function getActiveBorrowingBookDetail($curriculumId)
    {
        // return self::select('borrowing_books.*', 'users.name', 'users.identity_number', 'classrooms.name as classroom_name')
        //     ->leftJoin('borrowing_book_details', 'borrowing_books.id', '=', 'borrowing_book_details.borrowing_book_id')
        //     ->join('users', 'users.id', '=', 'borrowing_books.student_id')
        //     ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
        //     ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
        //     ->join('classrooms', 'classrooms.id', '=', 'teacher_homeroom_relationships.classroom_id')
        //     ->whereNull('borrowing_book_details.returned_date')
        //     ->where('teacher_homeroom_relationships.curriculum_id', $curriculumId)
        //     ->distinct()
        //     ->get();
    }
}
