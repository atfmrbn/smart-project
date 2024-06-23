<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TeacherHomeroomRelationship;
use App\Models\StudentTeacherHomeroomRelationship;

class StudentTeacherHomeroomRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classroom_id = $request->input('classroom');

        $query = StudentTeacherHomeroomRelationship::join('users as students', 'student_teacher_homeroom_relationships.student_id', '=', 'students.id')
            ->join('teacher_homeroom_relationships as thr', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id', '=', 'thr.id')
            ->join('classrooms', 'thr.classroom_id', '=', 'classrooms.id')
            ->select([
                'students.identity_number',
                'student_teacher_homeroom_relationships.*',
                'classrooms.name as classroom_name',
            ]);

        // Filter berdasarkan classroom
        if ($classroom_id) {
            $query->where('classrooms.id', $classroom_id);
        }

        $studentTeacherHomeroomRelationships = $query->get();
        $classrooms = Classroom::all();

        $data = [
            'title' => 'Student Teacher Homerooms',
            'studentTeacherHomeroomRelationships' => $studentTeacherHomeroomRelationships,
            'classrooms' => $classrooms,
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

        return redirect()->route('student-teacher-homeroom.index')->with('successMessage', 'Add data successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studentTeacherHomeroomRelationship = StudentTeacherHomeroomRelationship::findOrFail($id);

        return view('student.student-teacher-homeroom.detail', [
            'title' => 'Student Teacher Homeroom Detail',
            'studentTeacherHomeroomRelationship' => $studentTeacherHomeroomRelationship,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $studentTeacherHomeroomRelationship = StudentTeacherHomeroomRelationship::findOrFail($id);
        $students = User::where('role', 'Student')->get();
        $teacherHomeroomRelationships = TeacherHomeroomRelationship::all();

        return view('student.student-teacher-homeroom.form', [
            'title' => 'Edit Student Teacher Homeroom',
            'studentTeacherHomeroomRelationship' => $studentTeacherHomeroomRelationship,
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
            $studentTeacherHomeroomRelationship = StudentTeacherHomeroomRelationship::findOrFail($id);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $studentTeacherHomeroomRelationship->update($data);

            return redirect()->route('student-teacher-homeroom.index')->with('successMessage', 'Data successfully updated');
        } catch (\Throwable $th) {
            return redirect()->route('student-teacher-homeroom.edit', $id)->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $studentTeacherHomeroomRelationship = StudentTeacherHomeroomRelationship::findOrFail($id);
            $studentTeacherHomeroomRelationship->delete();

            return redirect()->route('student-teacher-homeroom.index')->with('successMessage', 'Data successfully deleted');
        } catch (\Throwable $th) {
            return redirect()->route('student-teacher-homeroom.index')->with('error', $th->getMessage());
        }
    }

    public function download()
    {
    $studentTeacherHomeroomRelationships = StudentTeacherHomeroomRelationship::with(['student', 'teacherHomeroomRelationship.teacher', 'teacherHomeroomRelationship.classroom'])->get();

    $data = [
        'title' => 'Student-Teacher Homeroom Report',
        'studentTeacherHomeroomRelationships' => $studentTeacherHomeroomRelationships
    ];

    $pdf = \Barryvdh\DomPDF\Facade\PDF::loadView('student.student-teacher-homeroom.report', $data);
    $pdf->setPaper('a4', 'landscape');

    return $pdf->download('student_teacher_homeroom_report.pdf');
    }


}
