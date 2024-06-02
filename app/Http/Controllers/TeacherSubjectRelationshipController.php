<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\TeacherHomeroomRelationship;
use App\Models\TeacherSubjectRelationship;
use App\Models\TeacherClassroomRelationship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherSubjectRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher_subjects = TeacherSubjectRelationship::
        with('teacher', 'subject')
        ->orderBy('subject_id')
        ->get();
        // dd($teacher_subjects[2]->subject);
        $data = [
            'title' => 'Teacher Subjects',
            'teacher_subjects' => $teacher_subjects->isEmpty() ? [] : $teacher_subjects,
        ];

        return view('teacher.teacher-subject.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::where('role', 'Teacher')->get();
        $subjects = Subject::all(); // Perbaiki bagian ini, karena Subject tidak memerlukan relasi 'subject'

        return view('teacher.teacher-subject.form',  [
            'title' => 'Add Teacher Subject',
            'teachers' => $teachers,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
        ]);
        $data['curriculum_id'] = $this->defaultCurriculum->id;

        TeacherSubjectRelationship::create($data);

        return redirect()->route('teacher-subject.index')->with('successMessage', 'Data successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher_subject = TeacherSubjectRelationship::findOrFail($id);

        return view('teacher.teacher-subject.detail', [
            'title' => 'Teacher Detail',
            'teacher_subject' => $teacher_subject,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher_subject = TeacherSubjectRelationship::findOrFail($id);
        $teachers = User::where('role', 'Teacher')->get();
        $subjects = Subject::all();

        return view('teacher.teacher-subject.form', [
            'title' => 'Edit Teacher Subject',
            'teacher_subject' => $teacher_subject,
            'teachers' => $teachers,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
        ]);

        try {
            $teacher_subject = TeacherSubjectRelationship::findOrFail($id);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $teacher_subject->update($data);

            return redirect()->route('teacher-subject.index')->with('successMessage', 'Data successfully updated');
        } catch (\Throwable $th) {
            return redirect()->route('teacher-subject.edit', $id)->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $teacher_subject = TeacherSubjectRelationship::findOrFail($id);
            $teacher_subject->delete();

            return redirect()->route('teacher-subject.index')->with('successMessage', 'Data successfully deleted');
        } catch (\Throwable $th) {
            return redirect()->route('teacher-subject.index')->with('errorMessage', $th->getMessage());
        }
    }
}
