<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingBook extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function borrowDetail()
    {
        return $this->hasMany(BorrowingBookDetail::class);
    }

    public static function getActiveBorrowingBook($curriculumId)
    {
        return self::select('borrowing_books.*', 'users.name', 'users.identity_number', 'classrooms.name as classroom_name')
            ->leftJoin('borrowing_book_details', 'borrowing_books.id', '=', 'borrowing_book_details.borrowing_book_id')
            ->join('users', 'users.id', '=', 'borrowing_books.student_id')
            ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
            ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
            ->join('classrooms', 'classrooms.id', '=', 'teacher_homeroom_relationships.classroom_id')
            ->whereNull('borrowing_book_details.returned_date')
            ->where('teacher_homeroom_relationships.curriculum_id', $curriculumId)
            ->distinct()
            ->get();
    }
    public static function getInactiveBorrowingBook($curriculumId)
    {
        return self::select('borrowing_books.*', 'users.name', 'users.identity_number', 'classrooms.name as classroom_name')
            ->leftJoin('borrowing_book_details', 'borrowing_books.id', '=', 'borrowing_book_details.borrowing_book_id')
            ->join('users', 'users.id', '=', 'borrowing_books.student_id')
            ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
            ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
            ->join('classrooms', 'classrooms.id', '=', 'teacher_homeroom_relationships.classroom_id')
            ->whereNotNull('borrowing_book_details.returned_date')
            ->where('teacher_homeroom_relationships.curriculum_id', $curriculumId)
            ->distinct()
            ->get();
    }
}
