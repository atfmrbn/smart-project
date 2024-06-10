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
  
    public function librarian()
    {
        $data = [
            "title" => "Dashboard",
        ];

        return view("dashboard.librarian", $data);


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
            "extracurricularCount" => $extracurriculars->count(),
            "extracurriculars" => $extracurriculars,
        ];

        return view("dashboard.student", $data);
    }
}

