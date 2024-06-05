<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TeacherHomeroomRelationship;
use App\Models\StudentTeacherHomeroomRelationship;

class StudentTeacherHomeroomRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student_teacher_homerooms = StudentTeacherHomeroomRelationship::
        with('student', 'teacherHomeroomRelationship')->get();

        $data = [
            'title' => 'Student Teacher Homeroom',
            'student_teacher_homerooms' => $student_teacher_homerooms->isEmpty() ? [] : $student_teacher_homerooms,
        ];

        return view('student.student-teacher-homeroom.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'Student')->get();
        $teacherHomeroomRelationships = TeacherHomeroomRelationship::all();

        return view('student.student-teacher-homeroom.form',  [
            'title' => 'Add Student Teacher Homeroom',
            'students' => $students,
            'teacherHomeroomRelationships' => $teacherHomeroomRelationships,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required',
            'teacher_homeroom_relationship_id' => 'required',
        ]);
        $data['curriculum_id'] = $this->defaultCurriculum->id;

        StudentTeacherHomeroomRelationship::create($data);

        return redirect()->route('student/student-teacher-homeroom.index')->with('success', 'Add data successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student_teacher_homeroom = StudentTeacherHomeroomRelationship::findOrFail($id);

        return view('student.student-teacher-homeroom.detail', [
            'title' => 'Student Teacher Homeroom Detail',
            'student_teacher_homeroom' => $student_teacher_homeroom,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student_teacher_homeroom = StudentTeacherHomeroomRelationship::findOrFail($id);
        $students = User::where('role', 'Student')->get();
        $teacherHomeroomRelationships = TeacherHomeroomRelationship::all();

        return view('student.student-teacher-homeroom.form', [
            'title' => 'Edit Student Teacher Homeroom',
            'student_teacher_homeroom' => $student_teacher_homeroom,
            'students' => $students,
            'teacherHomeroomRelationships' => $teacherHomeroomRelationships,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'student_id' => 'required',
            'teacher_homeroom_relationship_id' => 'required',
        ]);

        try {
            $student_teacher_homeroom = StudentTeacherHomeroomRelationship::findOrFail($id);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $student_teacher_homeroom->update($data);

            return redirect()->route('student.student-teacher-homeroom.index')->with('successMessage', 'Data successfully updated');
        } catch (\Throwable $th) {
            return redirect()->route('student.student-teacher-homeroom.edit')->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student_teacher_homeroom = StudentTeacherHomeroomRelationship::findOrFail($id);
            $student_teacher_homeroom->delete();

            return redirect()->route('student.student-teacher-homeroom.index')->with('successMessage', 'Data successfully deleted');
        } catch (\Throwable $th) {
            return redirect()->route('student.student-teacher-homeroom.index')->with('errorMessage', $th->getMessage());
        }
    }
}
