<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\TeacherHomeroomRelationship;
use App\Models\TeacherClassroomRelationship;
use App\Models\TeacherSubjectRelationship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherClassroomRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $schedule_day = $request->input('schedule_day');
        $classroom_id = $request->input('classroom');

        $query = TeacherClassroomRelationship::with('curriculum', 'classroom', 'teacherSubjectRelationship')
            ->where('curriculum_id', $this->defaultCurriculum->id);

        if ($schedule_day) {
            $query->where('schedule_day', $schedule_day);
        }

        if ($classroom_id) {
            $query->where('classroom_id', $classroom_id);
        }

        $teacher_classrooms = $query->orderBy('classroom_id')->get();

        $scheduleDays = TeacherClassroomRelationship::distinct()->pluck('schedule_day');
        $classrooms = Classroom::with('classroomType')->get();

        $data = [
            'title' => 'Teacher Classrooms',
            'teacher_classrooms' => $teacher_classrooms->isEmpty() ? [] : $teacher_classrooms,
            'scheduleDays' => $scheduleDays,
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
        $classrooms = Classroom::with('classroomType')->get();
        $teacherSubjectRelationships = TeacherSubjectRelationship::with('teacher','subject')->get();

        return view('teacher.teacher-classroom.form',  [
            'title' => 'Add Teacher Classroom',
            'teachers' => $teachers,
            'classrooms' => $classrooms,
            'teacherSubjectRelationships' => $teacherSubjectRelationships,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'classroom_id' => 'required',
            'teacher_subject_relationship_id' => 'required',
            'schedule_day' => 'required',
            'schedule_time_start' => 'required',
            'schedule_time_end' => 'required',
        ]);
        $data['curriculum_id'] = $this->defaultCurriculum->id;
        // dd($data);
        try
        {
            TeacherClassroomRelationship::create($data);

            return redirect()->route('teacher-classroom.index')->with('successMessage', 'Data successfully added');
        }
        catch (\Exception $ex)
        {
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
        $teachers = User::where('role', 'Teacher')->get();
        $classrooms = Classroom::with('classroomType')->get();
        $teacherSubjectRelationships = TeacherSubjectRelationship::with('teacher', 'subject')->get();

        return view('teacher.teacher-classroom.form', [
            'title' => 'Edit Teacher Classroom',
            'teacher_classroom' => $teacher_classroom,
            'teachers' => $teachers,
            'classrooms' => $classrooms,
            'teacherSubjectRelationships' => $teacherSubjectRelationships,
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
}
