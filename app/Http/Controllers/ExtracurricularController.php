<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extracurriculars = Extracurricular::with(['student', 'admin'])
        ->orderBy('id')
        ->get();

        $data = [
            "title" => "Extracurriculars",
            "extracurriculars" => $extracurriculars,
        ];

        return view('extracurricular.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'Student')->orderBy('name')->get();
        $admins = User::where('role', 'Admin')->orderBy('name')->get();
        $data = [
            "title" => "Add Extracurricular",
            "students" => $students,
            "admins" => $admins,
        ];

        return view('extracurricular.extracurricular_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'student_id' => 'required|exists:users,id',
            'admin_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        try {
            Extracurricular::create($data);

            return redirect('extracurricular')->with("successMessage", "Add data successful");
        } catch (\Throwable $th) {
            return redirect('extracurricular')->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $extracurricular = Extracurricular::with(['student', 'admin'])->findOrFail($id);

        return view('extracurricular.extracurricular_detail', [
            'title' => 'Extracurricular Detail',
            'extracurricular' => $extracurricular,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $extracurricular = Extracurricular::findOrFail($id);
        $students = User::where('role', 'Student')->orderBy('name')->get();
        $admins = User::where('role', 'Admin')->orderBy('name')->get();

        return view('extracurricular.extracurricular_form', [
            'title' => 'Edit Extracurricular',
            'extracurricular' => $extracurricular,
            'students' => $students,
            'admins' => $admins,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'student_id' => 'required|exists:users,id',
            'admin_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        try {
            $extracurricular = Extracurricular::findOrFail($id);
            $extracurricular->update($data);

            return redirect()->route('extracurricular.index')->with('successMessage', 'Data successfully updated');
        } catch (\Throwable $th) {
            return redirect()->route('extracurricular.edit', $id)->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $extracurricular = Extracurricular::findOrFail($id);
            $extracurricular->delete();

            return redirect()->route('extracurricular.index')->with('successMessage', 'Data successfully deleted');
        } catch (\Throwable $th) {
            return redirect()->route('extracurricular.index')->with('errorMessage', $th->getMessage());
        }
    }
}
