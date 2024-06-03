<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\TeacherHomeroomRelationship;
use App\Models\TeacherClassroomRelationship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherClassroomRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher_classrooms = TeacherClassroomRelationship::
        with('teacher', 'curriculum', 'classroom')
        ->where('curriculum_id', $this->defaultCurriculum->id)
        ->orderBy('classroom_id')
        ->get();
        // dd($teacher_classrooms[2]->classroom);
        $data = [
            'title' => 'Teacher Classrooms',
            'teacher_classrooms' => $teacher_classrooms->isEmpty() ? [] : $teacher_classrooms,
        ];

        return view('teacher.teacher-classroom.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::where('role', 'Teacher')->get();
        $classrooms = Classroom::with('classroomType')->get();

        return view('teacher.teacher-classroom.form',  [
            'title' => 'Add Teacher Classroom',
            'teachers' => $teachers,
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_id' => 'required',
            'classroom_id' => 'required',
        ]);
        $data['curriculum_id'] = $this->defaultCurriculum->id;

        TeacherClassroomRelationship::create($data);

        return redirect()->route('teacher-classroom.index')->with('successMessage', 'Data successfully added');
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
        $teachers = User::where('role', 'Teacher')->get();
        $classrooms = Classroom::with('classroomType')->get();

        return view('teacher.teacher-classroom.form', [
            'title' => 'Edit Teacher Homeroom',
            'teacher_classroom' => $teacher_classroom,
            'teachers' => $teachers,
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'teacher_id' => 'required',
            'classroom_id' => 'required',
        ]);

        try {
            $teacher_classroom = TeacherClassroomRelationship::findOrFail($id);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

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
}
