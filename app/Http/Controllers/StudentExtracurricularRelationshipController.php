<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\StudentExtracurricularRelationship;
use App\Models\User;
use Illuminate\Http\Request;

class StudentExtracurricularRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extracurricular_students = StudentExtracurricularRelationship::with(['student', 'extracurricular', 'admin'])
            ->orderBy('id')
            ->get();

        $data = [
            "title" => "Extracurricular Participants",
            "extracurricular_students" => $extracurricular_students,
        ];

        return view('extracurricular.extracurricular-student.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'Student')->orderBy('name')->get();
        $extracurriculars = Extracurricular::orderBy('name')->get();
        $admins = User::where('role', 'Admin')->orderBy('name')->get();
        $data = [
            "title" => "Add Extracurricular Student",
            "students" => $students,
            "extracurriculars" => $extracurriculars,
            "admins" => $admins,
        ];
        
        return view('extracurricular.extracurricular-student.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'student_id' => 'required|exists:users,id',
            'extracurricular_id' => 'required|exists:extracurriculars,id',
            'admin_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        try {
            StudentExtracurricularRelationship::create($data);

            return redirect('extracurricular.extracurricular-student')->with("successMessage", "Add data successful");
        } catch (\Throwable $th) {
            return redirect('extracurricular.extracurricular-student')->with("errorMessage", $th->getMessage());
        }
    }

     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $extracurricular_student = StudentExtracurricularRelationship::with(['student', 'extracurricular', 'admin'])->findOrFail($id);

        return view('extracurricular.extracurricular-student.detail', [
            'title' => 'Extracurricular Student Detail',
            'extracurricular_student' => $extracurricular_student,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $extracurricular_student = StudentExtracurricularRelationship::findOrFail($id);
        $students = User::where('role', 'Student')->orderBy('name')->get();
        $extracurriculars = Extracurricular::orderBy('name')->get();
        $admins = User::where('role', 'Admin')->orderBy('name')->get();

        return view('extracurricular.extracurricular-student.form', [
            'title' => 'Edit Extracurricular Student',
            'extracurricular_student' => $extracurricular_student,
            'students' => $students,
            'extracurriculars' => $extracurriculars,
            'admins' => $admins,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'student_id' => 'required|exists:users,id',
            'extracurricular_id' => 'required|exists:extracurriculars,id',
            'admin_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        try {
            $extracurricular_student = StudentExtracurricularRelationship::findOrFail($id);
            $extracurricular_student->update($data);

            return redirect()->route('extracurricular.extracurricular-student.index')->with('successMessage', 'Data successfully updated');
        } catch (\Throwable $th) {
            return redirect()->route('extracurricular.extracurricular-student.edit', $id)->with('errorMessage', $th->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $extracurricular_student = StudentExtracurricularRelationship::findOrFail($id);
            $extracurricular_student->delete();

            return redirect()->route('extracurricular.extracurricular-student.index')->with('successMessage', 'Data successfully deleted');
        } catch (\Throwable $th) {
            return redirect()->route('extracurricular.extracurricular-student.index')->with('errorMessage', $th->getMessage());
        }
    }
}
