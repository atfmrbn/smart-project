<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\StudentTeacherHomeroomRelationship;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with('studentTeacherHomeroomRelationship.teacherHomeroomRelationship.teacher')
        ->get();


        $data = [
            'title' => 'Attendances',
            'attendances' => $attendances,
        ];

        return view('attendance.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studentTeacherHomeroomRelationships = StudentTeacherHomeroomRelationship::all();

        $data = [
            'title' => 'Add Attendance',
            'studentTeacherHomeroomRelationships' => $studentTeacherHomeroomRelationships,
        ];

        return view('attendance.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_teacher_homeroom_id' => 'required',
            'attendance_date' => 'required',
            'note' => 'required',
            'status' => 'required',
        ]);

        try
        {
            Attendance::create($data);

            return redirect()->route('attendance.index')->with('successMessage', 'Data successfully added');
        }
        catch (Exception $ex)
        {
            return redirect()->route('attendance.index')->with('errorMessage', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::findOrFail($id);

        return view('attendance.detail', [
            'title' => 'Attendance Detail',
            'attendance' => $attendance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $studentTeacherHomeroomRelationships = StudentTeacherHomeroomRelationship::all();

        return view('attendance.form', [
            'title' => 'Edit Attendance',
            'attendance' => $attendance,
            'studentTeacherHomeroomRelationships' => $studentTeacherHomeroomRelationships,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'student_teacher_homeroom_id' => 'required',
            'attendance_date' => 'required',
            'note' => 'required',
            'status' => 'required',
        ]);
    
        try
        {
            $attendance = Attendance::findOrFail($id);
            $attendance->update($data);
    
            return redirect()->route('attendance.index')->with('successMessage', 'Data successfully updated');
        }
        catch (Exception $ex)
        {
            return redirect()->route('attendance.index')->with('errorMessage', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $attendance = Attendance::findOrFail($id);
            $attendance->delete();

            return redirect()->route('attendance.index')->with('success', 'Data successfully deleted');
        } catch (\Throwable $th) {
            return redirect()->route('attendance.index')->with('error', $th->getMessage());
        }
    }

    public function download()
    {
        $attendances = Attendance::with('studentTeacherHomeroomRelationship.teacherHomeroomRelationship.teacher')
        ->get();

        $data = [
            'title' => 'Attendance',
            'attendances' => $attendances,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('attendance.report', $data);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('attendance.pdf');
    }
}
