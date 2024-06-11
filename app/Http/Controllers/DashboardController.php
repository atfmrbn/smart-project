<?php

namespace App\Http\Controllers;

use App\Models\StudentExtracurricularRelationship;
use App\Models\StudentTeacherHomeroomRelationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data = [
            "title" => "Dashboard",
        ];

        return view("dashboard.librarian", $data);
    }

    public function student()
    {
        $student_id = Auth::id(); // Get the logged-in student's ID

        $extracurriculars = StudentExtracurricularRelationship::join('extracurriculars as extra', 'student_extracurricular_relationships.extracurricular_id', '=', 'extra.id')
            ->select([
                'extra.name as extracurricular_name',
                'extra.description as extracurricular_description',
                'student_extracurricular_relationships.id'
            ])
            ->where('student_extracurricular_relationships.student_id', $student_id)
            ->get();

        $data = [
            "title" => "Student Dashboard",
            "extracurriculars" => $extracurriculars,
        ];

        return view("dashboard.student", $data);
    }
}

