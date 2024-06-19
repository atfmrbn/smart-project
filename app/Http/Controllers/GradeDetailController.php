<?php

namespace App\Http\Controllers;

use App\Models\GradeDetail;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\PDF;

class GradeDetailController extends Controller
{
    public function index(Request $request)
    {
    $grades = Grade::with(['taskType', 'teacherClassroomRelationship.teacherHomeroomRelationship.classroom.classroomType', 'teacherClassroomRelationship.teacherSubjectRelationship.teacher', 'teacherClassroomRelationship.teacherSubjectRelationship.subject'])->get();
    $students = User::where('role', 'student')->get();

    // Sort grades alphabetically by task type name
    $grades = $grades->sortBy(function ($grade) {
        return $grade->taskType->name ?? '';
    });

    // Sort students alphabetically by name
    $students = $students->sortBy('name');

    $gradeDetailsQuery = GradeDetail::with(['grade', 'student']);

    if ($request->filled('grade_id')) {
        $gradeDetailsQuery->whereHas('grade', function ($query) use ($request) {
            $query->where('id', $request->grade_id);
        });
    }

    if ($request->filled('student_id')) {
        $gradeDetailsQuery->where('student_id', $request->student_id);
    }

    $gradeDetails = $gradeDetailsQuery->get();

    $data = [
        'title' => 'Grade Details',
        'gradeDetails' => $gradeDetails,
        'grades' => $grades,
        'students' => $students,
    ];

    return view('teacher.grade-detail.index', $data);
    }

    public function create()
    {
        $grades = Grade::all();
        $students = User::where('role', 'student')->get();
        $title = 'Add Grade Detail';

        return view('teacher.grade-detail.form', compact('grades', 'students', 'title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'student_id' => 'required|exists:users,id',
            'value' => 'required|numeric|min:0|max:100',
        ]);

        GradeDetail::create($validatedData);

        return redirect()->route('grade-detail.index')
                         ->with('success', 'GradeDetail successfully added');
    }

    public function show(GradeDetail $gradeDetail)
    {
        $grades = Grade::all();
        $students = User::where('role', 'student')->get();
        $title = 'Show GradeDetail';

        return view('teacher.grade-detail.show', compact('gradeDetail', 'grades', 'students', 'title'));
    }

    public function edit(GradeDetail $gradeDetail)
    {
        $grades = Grade::all();
        $students = User::where('role', 'student')->get();
        $title = 'Edit GradeDetail';

        return view('teacher.grade-detail.form', compact('gradeDetail', 'grades', 'students', 'title'));
    }

    public function update(Request $request, GradeDetail $gradeDetail)
    {
        $validatedData = $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'student_id' => 'required|exists:users,id',
            'value' => 'required|numeric|min:0|max:100',
        ]);

        $gradeDetail->update($validatedData);

        return redirect()->route('grade-detail.index')
                         ->with('success', 'GradeDetail successfully updated');
    }

    public function destroy(GradeDetail $gradeDetail)
    {
        $gradeDetail->delete();

        return redirect()->route('grade-detail.index')
                         ->with('success', 'GradeDetail successfully deleted');
    }

    public function download(Request $request)
    {
        $grades = Grade::all();
        $students = User::where('role', 'student')->get();

        $gradeDetailsQuery = GradeDetail::with(['grade', 'student']);

        if ($request->filled('grade_id')) {
            $gradeDetailsQuery->whereHas('grade', function ($query) use ($request) {
                $query->where('id', $request->grade_id);
            });
        }

        if ($request->filled('student_id')) {
            $gradeDetailsQuery->where('student_id', $request->student_id);
        }

        $gradeDetails = $gradeDetailsQuery->get();

        $data = [
            'title' => 'Grade Details',
            'gradeDetails' => $gradeDetails,
            'grades' => $grades,
            'students' => $students,
        ];

        $pdf = PDF::loadView('teacher.grade-detail.report', $data);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('grade-details.pdf');
    }
}
