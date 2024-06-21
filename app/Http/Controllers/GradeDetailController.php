<?php

namespace App\Http\Controllers;

use App\Models\GradeDetail;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;

class GradeDetailController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'Teacher') {
            // Only fetch grades related to the logged-in teacher
            $grades = Grade::with([
                'taskType', 
                'teacherClassroomRelationship.teacherHomeroomRelationship.classroom.classroomType', 
                'teacherClassroomRelationship.teacherSubjectRelationship.teacher', 
                'teacherClassroomRelationship.teacherSubjectRelationship.subject'
            ])->whereHas('teacherClassroomRelationship.teacherSubjectRelationship', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->get();

            $students = User::where('role', 'Student')->get();

            // Sort grades alphabetically by task type name
            $grades = $grades->sortBy(function ($grade) {
                return $grade->taskType->name ?? '';
            });

            // Sort students alphabetically by name
            $students = $students->sortBy('name');
        } else {
            // If the user is a student, they should only see their own grades
            $grades = Grade::with([
                'taskType', 
                'teacherClassroomRelationship.teacherHomeroomRelationship.classroom.classroomType', 
                'teacherClassroomRelationship.teacherSubjectRelationship.teacher', 
                'teacherClassroomRelationship.teacherSubjectRelationship.subject'
            ])->whereHas('gradeDetails', function ($query) use ($user) {
                $query->where('student_id', $user->id);
            })->get();

            // Students shouldn't see other students
            $students = collect([$user]);
        }

        $gradeDetailsQuery = GradeDetail::with(['grade', 'student']);

        if ($request->filled('grade_id')) {
            $gradeDetailsQuery->whereHas('grade', function ($query) use ($request) {
                $query->where('id', $request->grade_id);
            });
        }

        if ($request->filled('student_id')) {
            // Ensure the student can only see their own grades
            if ($user->role === 'Student' && $user->id != $request->student_id) {
                abort(403, 'Unauthorized action.');
            }
            $gradeDetailsQuery->where('student_id', $request->student_id);
        } else if ($user->role === 'Student') {
            // For students, default to filtering by their own ID
            $gradeDetailsQuery->where('student_id', $user->id);
        }

        // For teachers, filter the grade details by their own classes
        if ($user->role === 'Teacher') {
            $gradeDetailsQuery->whereHas('grade.teacherClassroomRelationship.teacherSubjectRelationship', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            });
        }

        $gradeDetails = $gradeDetailsQuery->get();

        $data = [
            'title' => 'Grade Details',
            'gradeDetails' => $gradeDetails,
            'grades' => $grades,
            'students' => $students,
            'userRole' => $user->role,
        ];

        return view('teacher.grade-detail.index', $data);
    }


    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'Teacher') {
            // Only fetch grades related to the logged-in teacher
            $grades = Grade::with([
                'taskType', 
                'teacherClassroomRelationship.teacherHomeroomRelationship.classroom.classroomType', 
                'teacherClassroomRelationship.teacherSubjectRelationship.teacher', 
                'teacherClassroomRelationship.teacherSubjectRelationship.subject'
            ])->whereHas('teacherClassroomRelationship.teacherSubjectRelationship', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->get();
        } else {
            // If the user is not a teacher, they should not access this page
            abort(403, 'Unauthorized action.');
        }

        $students = User::where('role', 'Student')->get();
        $title = 'Add Grade Detail';

        return view('teacher.grade-detail.form', compact('grades', 'students', 'title'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'student_id' => 'required|exists:users,id',
            'value' => 'required|numeric|min:0|max:100',
        ]);

        // Ensure the grade belongs to the logged-in teacher
        $grade = Grade::with('teacherClassroomRelationship.teacherSubjectRelationship')
                    ->whereHas('teacherClassroomRelationship.teacherSubjectRelationship', function ($query) use ($user) {
                        $query->where('teacher_id', $user->id);
                    })
                    ->findOrFail($request->grade_id);

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
        $user = Auth::user();

        if ($user->role === 'Teacher') {
            // Only fetch grades related to the logged-in teacher
            $grades = Grade::with([
                'taskType', 
                'teacherClassroomRelationship.teacherHomeroomRelationship.classroom.classroomType', 
                'teacherClassroomRelationship.teacherSubjectRelationship.teacher', 
                'teacherClassroomRelationship.teacherSubjectRelationship.subject'
            ])->whereHas('teacherClassroomRelationship.teacherSubjectRelationship', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->get();
        } else {
            // If the user is not a teacher, they should not access this page
            abort(403, 'Unauthorized action.');
        }
        // $grades = Grade::all();
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
