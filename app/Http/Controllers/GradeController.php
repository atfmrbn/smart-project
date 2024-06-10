<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\TaskType;
use App\Models\StudentTeacherHomeroomRelationship;
use App\Models\User;
use App\Models\TeacherClassroomRelationship;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['taskType', 'studentTeacherHomeroomRelationship'])->get();
        $title = 'Grades';

        return view('teacher.grade.index', compact('grades', 'title'));
    }

    public function create()
{
    $taskTypes = TaskType::all();
    $studentTeacherHomerooms = StudentTeacherHomeroomRelationship::all(); // Pastikan Anda mengganti 'StudentTeacherHomeroom' dengan nama model yang sesuai
    $title = 'Add Grades';

    return view('teacher.grade.form', compact('taskTypes', 'studentTeacherHomerooms', 'title'));
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task_type_id' => 'required',
            'student_teacher_homeroom_relationship_id' => 'required',
            'value' => 'required'
        ]);

        Grade::create($validatedData);

        return redirect()->route('teacher.grade.index')->with('success', 'Grade successfully added');
    }

    public function edit(Grade $grade)
    {
        $taskTypes = TaskType::all();
        $relationships = StudentTeacherHomeroomRelationship::all();
        $students = User::where('role', 'Student')->get();
        $teacherClassroomRelationships = TeacherClassroomRelationship::all();

        return view('teacher.grade.edit');
    }

    public function update(Request $request, Grade $grade)
    {
        $validatedData = $request->validate([
            'task_type_id' => 'required',
            'student_teacher_homeroom_relationship_id' => 'required',
            'value' => 'required'
        ]);

        $grade->update($validatedData);

        return redirect()->route('teacher.grade.index')->with('success', 'Grade successfully updated');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('teacher.grade.index')->with('success', 'Grade successfully deleted');
    }
}
