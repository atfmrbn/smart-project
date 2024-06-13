<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\TeacherSchedule;
use App\Models\TeacherClassroomRelationship;

class TeacherScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teacher_classroom_relationship_id = $request->input('teacher_classroom_relationship_id');
        $teacherSchedules = TeacherSchedule::with('teacherClassroomRelationship.teacherHomeroomRelationship.classroom.classroomType', 'teacherClassroomRelationship.teacherSubjectRelationship.teacher', 'teacherClassroomRelationship.teacherSubjectRelationship.subject');

        if ($teacher_classroom_relationship_id) {
            $teacherSchedules->where('teacher_classroom_relationship_id', $teacher_classroom_relationship_id);
        }

        $data = [
            "title" => "Teacher Schedule",
            "teacherSchedules" => $teacherSchedules->get(),
            "teacherClassroomRelationships" => $this->getTeacherClassroomRelationships(),
        ];

        return view('teacher.teacher-schedule.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Add Teacher Schedule",
            "teacherClassroomRelationships" => $this->getTeacherClassroomRelationships(),
        ];

        return view('teacher.teacher-schedule.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_classroom_relationship_id' => 'required',
            'schedule_day' => 'required',
            'schedule_time_start' => 'required',
            'schedule_time_end' => 'required',
        ]);

        TeacherSchedule::create($data);

        return redirect()->route('teacher-schedule.index')->with('success', 'Teacher Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacherSchedule = TeacherSchedule::findOrFail($id);
        $data = [
            "title" => "Teacher Schedule Detail",
            "teacherSchedule" => $teacherSchedule
    ];

        return view('teacher.teacher-schedule.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacherSchedule = TeacherSchedule::find($id);
        if (!$teacherSchedule) {
            return redirect('teacherSchedule')->with("errorMessage", 'Kurikulum tidak dapat ditemukan');
        }

        $teacherSchedules = TeacherSchedule::all();

        $data = [
            'title' => 'Edit Teacher Schedule',
            'teacherSchedule' => $teacherSchedule,
            "teacherClassroomRelationships" => $this->getTeacherClassroomRelationships(),
        ];

        return view('teacher.teacher-schedule.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'teacher_classroom_relationship_id' => 'required',
            'schedule_day' => 'required',
            'schedule_time_start' => 'required',
            'schedule_time_end' => 'required',
        ]);

        $teacherSchedule = TeacherSchedule::find($id);

        if (!$teacherSchedule) {
            return redirect()->route('teacher-schedule.index')->with('error', 'TeacherSchedule not found.');
        }
        $teacherSchedule->update($data); // Memanggil metode update() pada instance model $teacherSchedule

        return redirect()->route('teacher-schedule.index')->with('success', 'TeacherSchedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacherSchedule = TeacherSchedule::find($id);
        $teacherSchedule->delete();

        return redirect()->route('teacher-schedule.index')->with('success', 'TeacherSchedule deleted successfully.');
    }

    private function getTeacherClassroomRelationships()
    {
        return TeacherClassroomRelationship::with(['teacherHomeroomRelationship', 'teacherHomeroomRelationship.classroom.classroomType', 'teacherSubjectRelationship.teacher'])
        ->where('teacher_homeroom_relationships.curriculum_id', $this->defaultCurriculum->id)
        ->join('teacher_homeroom_relationships', 'teacher_classroom_relationships.teacher_homeroom_relationship_id', '=', 'teacher_homeroom_relationships.id')
        ->join('teacher_subject_relationships', 'teacher_classroom_relationships.teacher_subject_relationship_id', '=', 'teacher_subject_relationships.id')
        ->join('users', 'teacher_subject_relationships.teacher_id', '=', 'users.id')
        ->select('teacher_classroom_relationships.*', 'users.identity_number')->get();
    }

}
