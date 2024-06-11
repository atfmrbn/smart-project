<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BorrowingBook;
use App\Models\BorrowingBookDetail;
use App\Models\StudentExtracurricularRelationship;
use App\Models\StudentTeacherHomeroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function admin()
    {
        $data = [
            "title" => "Dashboard",
        ];

        return view("dashboard.admin", $data);
    }

    public function teacher()
    {
        $data = [
            "title" => "Dashboard",
        ];

        return view("dashboard.teacher", $data);
    }

    public function parent()
    {
        $data = [
            "title" => "Dashboard",
        ];
        // $user = Auth::user();
        // $parents = $user->parents; // Mendapatkan informasi orang tua dari user

        return view("dashboard.parent", $data);
        // compact('user', 'parents')
    }

    public function librarian()
    {
        $bookCount = Book::count();
        $categoryCount = BookCategory::count();
        $bookBorrowedCount = BorrowingBookDetail::count();
        $bookReturnCount = BorrowingBookDetail::whereNotNull('returned_date')->count();
        $studenBorrowCount = BorrowingBook::where('status', 'borrowing')->count();
        $studentReturnedCount = BorrowingBook::where('status', 'returned')->count();

        // Susun data untuk dikirim ke view
        $data = [
            "title" => "Librarian Dashboard",
            "bookCount" => $bookCount,
            "categoryCount" => $categoryCount,
            "studenBorrowCount" => $studenBorrowCount,
            "studentReturnedCount" => $studentReturnedCount,
            "bookBorrowedCount" => $bookBorrowedCount,
            "bookReturnCount" => $bookReturnCount,
        ];

        return view("dashboard.librarian", $data);
    }

    public function student()
    {
        $studentBorrowCount = BorrowingBook::where('status', 'borrowing')->count();
        $studentReturnedCount = BorrowingBook::where('status', 'returned')->count();
        $userId = Auth::id();
        $student = User::with(['studentTeacherHomeroom.teacherHomeroomRelationship.classroom', 'attendances'])
            ->where('id', $userId)    
            ->where('role', 'Student')
            ->firstOrFail();

        $extracurriculars = StudentExtracurricularRelationship::join('extracurriculars as extra', 'student_extracurricular_relationships.extracurricular_id', '=', 'extra.id')
            ->select([
                'extra.name as extracurricular_name',
                'extra.description as extracurricular_description',
                'student_extracurricular_relationships.id'
            ])
            ->where('student_extracurricular_relationships.student_id', $student->id)
            ->get();
        
        $subjectCount = Subject::count();
        $totalStudents = User::where('role', 'Student')->count();

        $data = [
            "title" => "Student Dashboard",
            "extracurricularCount" => $extracurriculars->count(),
            "extracurriculars" => $extracurriculars,
            "student" => $student,
            "studentCount" => $totalStudents,
            "studentBorrowCount" => $studentBorrowCount,
            "studentReturnedCount" => $studentReturnedCount,
            "subjectCount" => $subjectCount,
        ];

        return view("dashboard.student", $data);
    }
}