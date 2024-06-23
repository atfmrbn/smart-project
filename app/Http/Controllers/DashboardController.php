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
use App\Models\Curriculum;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentTeacherHomeroom;
use App\Models\TeacherSubjectRelationship;
use App\Models\TeacherClassroomRelationship;
use App\Models\StudentExtracurricularRelationship;
use App\Models\StudentTeacherHomeroomRelationship;
use App\Models\TeacherSchedule;
use App\Models\Tuition;

class DashboardController extends Controller
{

    public function admin()
    {
        $userId = Auth::id();

        // Fetch the logged-in student details
        $admin = User::where('id', $userId)
            ->where('role', 'Admin')
            ->firstOrFail();

        $adminCount = User::where('role', 'Admin')->count();

        $teacherCount = User::where('role', 'Teacher')->count();

        $teachers = User::where('role', 'Teacher')->paginate(3);

        $studentCount = User::where('role', 'Student')->count();

        $parentCount = User::where('role', 'Parent')->count();

        $librarianCount = User::where('role', 'Librarian')->count();

        $subjectCount = Subject::count();

        $classroomCount = Classroom::count();

        $curriculumCount = Curriculum::count();

        $tuitionCount = Tuition::count();

        $data = [
            "title" => "Admin Dashboard",
            "admin" => $admin,
            "adminCount" => $adminCount,
            "teacherCount" => $teacherCount,
            "studentCount" => $studentCount,
            "parentCount" => $parentCount,
            "librarianCount" => $librarianCount,
            "subjectCount" => $subjectCount,
            "classroomCount" => $classroomCount,
            "curriculumCount" => $curriculumCount,
            "tuitionCount" => $tuitionCount,
            "teachers" => $teachers,
        ];

        return view("dashboard.admin", $data);
    }

    public function superAdmin()
    {
        $userId = Auth::id();

        // Fetch the logged-in student details
        $superAdmin = User::where('id', $userId)
            ->where('role', 'Super Admin')
            ->firstOrFail();

        $adminCount = User::where('role', 'Admin')->count();

        $teacherCount = User::where('role', 'Teacher')->count();

        $teachers = User::where('role', 'Teacher')->paginate(3);

        $studentCount = User::where('role', 'Student')->count();

        $parentCount = User::where('role', 'Parent')->count();

        $librarianCount = User::where('role', 'Librarian')->count();

        $subjectCount = Subject::count();

        $classroomCount = Classroom::count();

        $curriculumCount = Curriculum::count();

        $tuitionCount = Tuition::count();

        $data = [
            "title" => "Super Admin Dashboard",
            "superAdmin" => $superAdmin,
            "adminCount" => $adminCount,
            "teacherCount" => $teacherCount,
            "studentCount" => $studentCount,
            "parentCount" => $parentCount,
            "librarianCount" => $librarianCount,
            "subjectCount" => $subjectCount,
            "classroomCount" => $classroomCount,
            "curriculumCount" => $curriculumCount,
            "tuitionCount" => $tuitionCount,
            "teachers" => $teachers,
        ];
        // $teacherCount = User::where('role', 'Teacher')->count();
        // $studentCount = User::where('role', 'Student')->count();
        // $adminCount = User::where('role', 'Admin')->count();
        // $parentCount = User::where('role', 'Parent')->count();
        // $librarianCount = User::where('role', 'Librarian')->count();

        // $data = [
        //     "title" => "Super Admin Dashboard",
        //     "teacherCount" => $teacherCount,
        //     "studentCount" => $studentCount,
        //     "adminCount" => $adminCount,
        //     "parentCount" => $parentCount,
        //     "librarianCount" => $librarianCount,
        // ];

        return view("dashboard.superAdmin", $data);
    }

    public function teacher()
    {
        $teacherId = Auth::id();

        // Mengambil data guru yang sedang login
        $teacher = User::with(['teacherHomeroomRelationships.classroom', 'attendances'])
            ->where('id', $teacherId)
            ->where('role', 'Teacher')
            ->firstOrFail();

        // // Mengambil data siswa yang terkait dengan guru
        // $students = User::whereHas('studentTeacherHomeroomRelationships.teacherHomeroomRelationship', function ($query) use ($teacherId) {
        //     $query->where('teacher_id', $teacherId);
        // })->get();

        // Mengambil data jadwal guru
        $teacherSchedules = TeacherSchedule::with([
            'teacherClassroomRelationship.teacherHomeroomRelationship.classroom.classroomType',
            'teacherClassroomRelationship.teacherSubjectRelationship.teacher',
            'teacherClassroomRelationship.teacherSubjectRelationship.subject'
        ])
            ->whereHas('teacherClassroomRelationship.teacherSubjectRelationship', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->orderBy('schedule_day')
            ->orderBy('schedule_time_start')
            ->get();

        // Mengambil data absensi guru
        $attendances = Attendance::whereHas('studentTeacherHomeroomRelationship', function ($query) use ($teacherId) {
            $query->whereHas('teacherHomeroomRelationship', function ($subQuery) use ($teacherId) {
                $subQuery->where('teacher_id', $teacherId);
            });
        })->get();

        // Menghitung data yang diperlukan untuk dashboard
        $studentCount = StudentTeacherHomeroomRelationship::whereHas('teacherHomeroomRelationship', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->distinct('student_id')->count('student_id');
        $teacherClassroomCount = TeacherClassroomRelationship::whereHas('teacherSubjectRelationship', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->count();
        $teacherSubjectCount = TeacherSubjectRelationship::where('teacher_id', $teacherId)->count();
        $attendanceCount = Attendance::whereHas('studentTeacherHomeroomRelationship', function ($query) use ($teacherId) {
            $query->whereHas('teacherHomeroomRelationship', function ($subQuery) use ($teacherId) {
                $subQuery->where('teacher_id', $teacherId);
            });
        })->count();

        $data = [
            "title" => "Teacher Dashboard",
            "studentCount" => $studentCount,
            "teacherClassroomCount" => $teacherClassroomCount,
            "teacherSubjectCount" => $teacherSubjectCount,
            "attendanceCount" => $attendanceCount,
            "teacher" => $teacher,
            "teacherSchedules" => $teacherSchedules,
            "attendances" => $attendances,
            // "students" => $students,
        ];

        return view("dashboard.teacher", $data);
    }


    public function parent()
    {
        $parentId = Auth::id();

        // Retrieve the parent's details
        $parent = User::with('child')->findOrFail($parentId);

        // Retrieve schedules for the parent's children
        $schedules = User::where('users.id', $parentId)
            ->join('users as child', 'child.parent_id', '=', 'users.id')
            ->join('student_teacher_homeroom_relationships as sthr', 'child.id', '=', 'sthr.student_id')
            ->join('teacher_homeroom_relationships as thr', 'sthr.teacher_homeroom_relationship_id', '=', 'thr.id')
            ->join('teacher_classroom_relationships as tcr', 'thr.id', '=', 'tcr.teacher_homeroom_relationship_id')
            ->join('teacher_schedules as ts', 'tcr.id', '=', 'ts.teacher_classroom_relationship_id')
            ->join('teacher_subject_relationships as tsr', 'tcr.teacher_subject_relationship_id', '=', 'tsr.id')
            ->join('users as teacher', 'tsr.teacher_id', '=', 'teacher.id')
            ->join('subjects', 'tsr.subject_id', '=', 'subjects.id')
            ->where('thr.curriculum_id', $this->defaultCurriculum->id)
            ->select('ts.*', 'teacher.name as teacher_name', 'subjects.name as subject_name')
            ->orderBy('ts.schedule_day')
            ->orderBy('ts.schedule_time_start')
            ->get();

        $data = [
            "title" => "Parent Dashboard",
            "parent" => $parent, // Pass the parent data to the view
            "schedules" => $schedules, // Pass the schedules data to the view
        ];

        return view("dashboard.parent", $data);
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
        $userId = Auth::id();

        // Count borrowing books for the logged-in student
        $studentBorrowCount = BorrowingBook::where('student_id', $userId)
            ->where('status', 'borrowing')
            ->count();

        // Count returned books for the logged-in student
        $studentReturnedCount = BorrowingBook::where('student_id', $userId)
            ->where('status', 'returned')
            ->count();

        // Fetch the logged-in student details
        $student = User::with(['studentTeacherHomeroom.teacherHomeroomRelationship.classroom', 'attendances'])
            ->where('id', $userId)
            ->where('role', 'Student')
            ->firstOrFail();

        // Use optional chaining and conditional checks to handle null cases
        $classroomId = optional(optional(optional($student->studentTeacherHomeroom)->teacherHomeroomRelationship)->classroom)->id;

        // Initialize teacher schedules as an empty collection
        $teacherSchedules = collect([]);

        // Fetch teacher schedules if classroom_id exists
        if ($classroomId) {
            $teacherSchedules = TeacherSchedule::with('teacherClassroomRelationship.teacherHomeroomRelationship.classroom.classroomType', 'teacherClassroomRelationship.teacherSubjectRelationship.teacher', 'teacherClassroomRelationship.teacherSubjectRelationship.subject')
                ->whereHas('teacherClassroomRelationship.teacherHomeroomRelationship', function ($query) use ($classroomId) {
                    $query->where('classroom_id', $classroomId);
                })
                ->get()
                ->sortBy('schedule_day') // Sort schedules by day if needed
                ->groupBy('schedule_day'); // Group schedules by day
        }

        // Fetch extracurricular activities for the logged-in student
        $extracurriculars = StudentExtracurricularRelationship::join('extracurriculars as extra', 'student_extracurricular_relationships.extracurricular_id', '=', 'extra.id')
            ->select([
                'extra.name as extracurricular_name',
                'extra.description as extracurricular_description',
                'student_extracurricular_relationships.id'
            ])
            ->where('student_extracurricular_relationships.student_id', $userId)
            ->get();

        // Count total subjects and students
        $subjectCount = Subject::count();
        $totalStudents = User::where('role', 'Student')->count();

        // Prepare data for the view
        $data = [
            "title" => "Student Dashboard",
            "extracurricularCount" => $extracurriculars->count(),
            "extracurriculars" => $extracurriculars,
            "student" => $student,
            "studentCount" => $totalStudents,
            "studentBorrowCount" => $studentBorrowCount,
            "studentReturnedCount" => $studentReturnedCount,
            "subjectCount" => $subjectCount,
            "teacherSchedules" => $teacherSchedules,
        ];

        // Return view with data
        return view("dashboard.student", $data);
    }
}
