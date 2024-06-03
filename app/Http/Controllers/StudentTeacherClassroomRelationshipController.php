<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentTeacherClassroomRelationship;

class StudentTeacherClassroomRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student_teacher_classrooms = StudentTeacherClassroomRelationship::with('student', 'teacher_classroom')
        ->orderBy('id')
        ->get();
        
        $data = [
            "title" => "Student, Teacher Classroom",
            "student_teacher_classrooms" => $student_teacher_classrooms
        ];

        return view('student.student-teacher-classroom.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
