<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Attendance;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Models\BorrowingBook;
use App\Models\BorrowingBookDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentTeacherHomeroom;
use App\Models\TeacherSubjectRelationship;
use App\Models\TeacherClassroomRelationship;
use App\Models\StudentExtracurricularRelationship;
use App\Models\StudentTeacherHomeroomRelationship;

class DashboardController extends Controller
{
    public function admin()
    {
        $data = [
            "title" => "Admin Dashboard",
        ];

        return view("dashboard.admin", $data);
    }

    public function teacher()
    {
        $teacherId = Auth::id();
        $teacher = User::with(['teacherHomeroomRelationships.classroom', 'attendances'])
            ->where('id', $teacherId)
            ->where('role', 'Teacher')
            ->firstOrFail();

        $studentCount = StudentTeacherHomeroomRelationship::whereHas('teacherHomeroomRelationship', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);       
        })->distinct('student_id')->count('student_id');        
        $teacherClassroomCount = TeacherClassroomRelationship::whereHas('teacherSubjectRelationship', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);})->count();        
        $teacherSubjectCount = TeacherSubjectRelationship::where('teacher_id', $teacherId)->count();
        $attendanceCount = Attendance::whereHas('studentTeacherHomeroomRelationship', function ($query) use ($teacherId) {
            $query->whereHas('teacherHomeroomRelationship', function ($subQuery) use ($teacherId) {
                $subQuery->where('teacher_id', $teacherId);
            });})->count();

        $data = [
            "title" => "Teacher Dashboard",
            "studentCount" => $studentCount,
            "teacherClassroomCount" => $teacherClassroomCount,
            "teacherSubjectCount" => $teacherSubjectCount,
            "attendanceCount" => $attendanceCount,
            "teacher" => $teacher,

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
        $studentBorrowCount = BorrowingBook::where('status', 'borrowing')->count();
        $studentReturnedCount = BorrowingBook::where('status', 'returned')->count();

        $overviewData = [
            'labels' => ['Books', 'Categories', 'Borrowed', 'Returned', 'Patrons Borrowed', 'Patrons Returned'],
            'data' => [$bookCount, $categoryCount, $bookBorrowedCount, $bookReturnCount, $studentBorrowCount, $studentReturnedCount],
        ];

        // ambil data dari 6 bulan terakhir
        $months = collect([]);
        $borrowsDataArray = collect([]);
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthLabel = $month->format('F');
            $months->push($monthLabel);

            $borrowCount = BorrowingBookDetail::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $borrowsDataArray->push($borrowCount);
        }

        // tampung data total buku yg dipinjam dalam 6 bulan terakhir
        $borrowsData = [
            'labels' => $months,
            'data' => $borrowsDataArray,
        ];

        $data = [
            "title" => "Librarian Dashboard",
            "bookCount" => $bookCount,
            "categoryCount" => $categoryCount,
            "studentBorrowCount" => $studentBorrowCount,
            "studentReturnedCount" => $studentReturnedCount,
            "bookBorrowedCount" => $bookBorrowedCount,
            "bookReturnCount" => $bookReturnCount,
            "overviewData" => $overviewData,
            "borrowsData" => $borrowsData,
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