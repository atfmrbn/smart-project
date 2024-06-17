<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\TeacherClassroomRelationship;
use App\Models\TeacherHomeroomRelationship;
use App\Models\TeacherSubjectRelationship;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherClassroomRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classroom_id = $request->input('classroom');

        // Modifikasi query untuk join dengan users
        $query = TeacherClassroomRelationship::with(['teacherHomeroomRelationship', 'teacherHomeroomRelationship.classroom.classroomType', 'teacherSubjectRelationship.teacher'])
            ->where('teacher_homeroom_relationships.curriculum_id', $this->defaultCurriculum->id)
            ->join('teacher_homeroom_relationships', 'teacher_classroom_relationships.teacher_homeroom_relationship_id', '=', 'teacher_homeroom_relationships.id')
            ->join('teacher_subject_relationships', 'teacher_classroom_relationships.teacher_subject_relationship_id', '=', 'teacher_subject_relationships.id')
            ->join('users', 'teacher_subject_relationships.teacher_id', '=', 'users.id')
            ->select('teacher_classroom_relationships.*', 'users.identity_number');

        if ($classroom_id) {
            $query->where('teacher_homeroom_relationships.classroom_id', $classroom_id);
        }

        $teacher_classrooms = $query->get();
        $classrooms = Classroom::with('classroomType')->get();

        $data = [
            'title' => 'Teacher Classrooms - Curriculum ' . $this->defaultCurriculum->year,
            'teacher_classrooms' => $teacher_classrooms->isEmpty() ? [] : $teacher_classrooms,
            'classrooms' => $classrooms,
        ];

        return view('teacher.teacher-classroom.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::where('role', 'Teacher')->get();
        $teacherHomeroomRelationships = TeacherHomeroomRelationship::with('classroom')->get();
        $teacherSubjectRelationships = TeacherSubjectRelationship::with('teacher', 'subject')->get();

        return view('teacher.teacher-classroom.form', [
            'title' => 'Add Teacher Classroom',
            'teachers' => $teachers,
            'teacherHomeroomRelationships' => $teacherHomeroomRelationships,
            'teacherSubjectRelationships' => $teacherSubjectRelationships,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_homeroom_relationship_id' => 'required',
            'teacher_subject_relationship_id' => 'required',
        ]);

        try {
            TeacherClassroomRelationship::create($data);

            return redirect()->route('teacher-classroom.index')->with('successMessage', 'Data successfully added');
        } catch (\Exception $ex) {
            return redirect()->route('teacher-classroom.index')->with('errorMessage', $ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher_classroom = TeacherClassroomRelationship::findOrFail($id);

        return view('teacher.teacher-classroom.detail', [
            'title' => 'Teacher Detail',
            'teacher_classroom' => $teacher_classroom,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher_classroom = TeacherClassroomRelationship::findOrFail($id);
        $teacherSubjectRelationships = TeacherSubjectRelationship::with('teacher', 'subject')->get();
        $teacherHomeroomRelationships = TeacherHomeroomRelationship::with('classroom')->get();

        return view('teacher.teacher-classroom.form', [
            'title' => 'Edit Teacher Classroom',
            'teacher_classroom' => $teacher_classroom,
            'teacherSubjectRelationships' => $teacherSubjectRelationships,
            'teacherHomeroomRelationships' => $teacherHomeroomRelationships,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'classroom_id' => 'required',
            'teacher_subject_relationship_id' => 'required',
            'schedule_day' => 'required',
            'schedule_time_start' => 'required',
            'schedule_time_end' => 'required',
        ]);

        try {
            $teacher_classroom = TeacherClassroomRelationship::findOrFail($id);
            $teacher_classroom->update($data);

            return redirect()->route('teacher-classroom.index')->with('successMessage', 'Data successfully updated');
        } catch (\Throwable $th) {
            return redirect()->route('teacher-classroom.edit', $id)->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $teacher_classroom = TeacherClassroomRelationship::findOrFail($id);
            $teacher_classroom->delete();

            return redirect()->route('teacher-classroom.index')->with('successMessage', 'Data successfully deleted');
        } catch (\Throwable $th) {
            return redirect()->route('teacher-classroom.index')->with('errorMessage', $th->getMessage());
        }
    }
    public function download()
    {
    // Retrieve data (adjust the query as per your application logic)
    $teacher_classrooms = TeacherClassroomRelationship::with(['teacherHomeroomRelationship.classroom.classroomType', 'teacherSubjectRelationship.teacher', 'teacherSubjectRelationship.subject'])->get();

    $data = [
        'title' => 'Teachers Classroom Report',
        'teacher_classrooms' => $teacher_classrooms
    ];

    // Load the view and generate the PDF
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('teacher.teacher-classroom.report', $data);
    $pdf->setPaper('a4', 'landscape');
    return $pdf->download('teachers_classroom_report.pdf');
    }




}
