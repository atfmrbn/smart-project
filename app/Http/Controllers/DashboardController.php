<?php

namespace App\Http\Controllers;

use App\Models\StudentExtracurricularRelationship;
use App\Models\StudentTeacherHomeroom;
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

    public function librarian()
    {
        $data = [
            "title" => "Dashboard",
        ];

        return view("dashboard.librarian", $data);
    }

    public function student()
    {
        $user_id = Auth::id(); // Get the logged-in user's ID
        $student = User::with(['studentTeacherHomeroom.teacherHomeroomRelationship.classroom', 'attendances'])
            ->where('id', $user_id)
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

        $data = [
            "title" => "Student Dashboard",
            "extracurricularCount" => $extracurriculars->count(),
            "extracurriculars" => $extracurriculars,
            "student" => $student,
        ];

        return view("dashboard.student", $data);
    }
}