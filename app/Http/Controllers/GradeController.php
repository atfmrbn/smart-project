<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\TaskType;
use App\Models\StudentTeacherHomeroomRelationship;
use App\Models\TeacherClassroomRelationship;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $taskTypes = TaskType::all();
        $teacherClassroomRelationships = TeacherClassroomRelationship::all();

        $gradesQuery = Grade::with(['taskType', 'teacherClassroomRelationship.teacherHomeroomRelationship.teacher']);

        if ($request->filled('task_type_id')) {
            $gradesQuery->where('task_type_id', $request->task_type_id);
        }

        if ($request->filled('teacher_classroom_relationship_id')) {
            $gradesQuery->where('teacher_classroom_relationship_id', $request->teacher_classroom_relationship_id);
        }

        $grades = $gradesQuery->get();

        $data = [
            'title' => 'Grades',
            'grades' => $grades,
            'taskTypes' => $taskTypes,
            'teacherClassroomRelationships' => $teacherClassroomRelationships,
        ];

        return view('teacher.grade.index', $data);
    }


    public function create()
    {
        $taskTypes = TaskType::all();
        $teacherClassroomRelationships = TeacherClassroomRelationship::all();
        $title = 'Add Grades';

        return view('teacher.grade.form', compact('taskTypes', 'teacherClassroomRelationships', 'title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task_type_id' => 'required|exists:task_types,id',
            'teacher_classroom_relationship_id' => 'required|exists:teacher_classroom_relationships,id',
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        Grade::create($validatedData);

        return redirect()->route('grade.index')->with('success', 'Grade successfully added');
    }

    public function edit(Grade $grade)
    {
        $taskTypes = TaskType::all();
        $teacherClassroomRelationships = TeacherClassroomRelationship::all();
        $title = 'Edit Grade';

        return view('teacher.grade.form', compact('grade', 'taskTypes', 'teacherClassroomRelationships', 'title'));
    }

    public function update(Request $request, Grade $grade)
    {
        $validatedData = $request->validate([
            'task_type_id' => 'required|exists:task_types,id',
            'teacher_classroom_relationship_id' => 'required|exists:teacher_classroom_relationships,id',
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        $grade->update($validatedData);

        return redirect()->route('grade.index')->with('success', 'Grade successfully updated');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grade.index')->with('success', 'Grade successfully deleted');
    }

    public function download(Request $request)
    {
        $taskTypes = TaskType::all();
        $teacherClassroomRelationships = TeacherClassroomRelationship::all();

        $gradesQuery = Grade::with(['taskType', 'teacherClassroomRelationship.teacherHomeroomRelationship.teacher']);

        if ($request->filled('task_type_id')) {
            $gradesQuery->where('task_type_id', $request->task_type_id);
        }

        if ($request->filled('teacher_classroom_relationship_id')) {
            $gradesQuery->where('teacher_classroom_relationship_id', $request->teacher_classroom_relationship_id);
        }

        $grades = $gradesQuery->get();

        $data = [
            'title' => 'Grades',
            'grades' => $grades,
            'taskTypes' => $taskTypes,
            'teacherClassroomRelationships' => $teacherClassroomRelationships,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\PDF::loadView('teacher.grade.report', $data);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('grades.pdf');
    }
}
