<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\TaskType;
use App\Models\StudentTeacherHomeroomRelationship;
use App\Models\TeacherClassroomRelationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Fetch task types
        $taskTypes = TaskType::all();

        // Fetch teacher classroom relationships based on user role
        if ($user->role === 'Admin' || $user->role === 'Super Admin') {
            $teacherClassroomRelationships = TeacherClassroomRelationship::with([
                'teacherHomeroomRelationship',
                'teacherSubjectRelationship.teacher',
                'teacherSubjectRelationship.subject'
            ])->get();
        } else {
            $teacherClassroomRelationships = TeacherClassroomRelationship::with([
                'teacherHomeroomRelationship',
                'teacherSubjectRelationship.teacher',
                'teacherSubjectRelationship.subject'
            ])->whereHas('teacherSubjectRelationship.teacher', function ($query) use ($user) {
                $query->where('id', $user->id); // Menggunakan 'id' karena kita mencari berdasarkan 'teacher_id' di 'teacher_subject_relationships'
            })->get();
        }

        // Build the grades query
        $gradesQuery = Grade::with([
            'taskType',
            'teacherClassroomRelationship.teacherHomeroomRelationship'
        ]);

        // Apply filters if provided
        if ($request->filled('task_type_id')) {
            $gradesQuery->where('task_type_id', $request->task_type_id);
        }

        if ($request->filled('teacher_classroom_relationship_id')) {
            $gradesQuery->where('teacher_classroom_relationship_id', $request->teacher_classroom_relationship_id);
        }

        // Filter grades based on user role
        if ($user->role !== 'Admin' && $user->role !== 'Super Admin') {
            $gradesQuery->whereHas('teacherClassroomRelationship.teacherSubjectRelationship.teacher', function ($query) use ($user) {
                $query->where('id', $user->id); // Menggunakan 'id' karena kita mencari berdasarkan 'teacher_id' di 'teacher_subject_relationships'
            });
        }

        // Get the filtered grades
        $grades = $gradesQuery->get();

        // Prepare the data for the view
        $data = [
            'title' => 'Grades',
            'grades' => $grades,
            'taskTypes' => $taskTypes,
            'teacherClassroomRelationships' => $teacherClassroomRelationships,
        ];

        // Return the view with data
        return view('teacher.grade.index', $data);
    }


    public function create()
    {
        $user = Auth::user();

        // Fetch task types and teacher classroom relationships only for the logged-in teacher
        $taskTypes = TaskType::all(); // Sesuaikan dengan relasi TaskType yang dimiliki oleh guru yang sedang login
        $teacherClassroomRelationships = TeacherClassroomRelationship::whereHas('teacherSubjectRelationship.teacher', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->get(); // Ambil hanya relasi kelas yang terkait dengan guru yang sedang login

        $title = 'Add Grade';

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
        $user = Auth::user();

        // Fetch task types and teacher classroom relationships only for the logged-in teacher
        $taskTypes = TaskType::all(); // Sesuaikan dengan relasi TaskType yang dimiliki oleh guru yang sedang login
        $teacherClassroomRelationships = TeacherClassroomRelationship::whereHas('teacherSubjectRelationship.teacher', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->get(); // Ambil hanya relasi kelas yang terkait dengan guru yang sedang login

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
