<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::where('role', 'Teacher')->get();

        $data = [
            'title' => 'Teachers'
        ];

        if ($teachers->isEmpty()) {
            // Jika tidak ada data teachers, pastikan untuk mengembalikan array kosong
            $teachers = [];
        }

        return view('teacher/teacher-list.index', compact('teachers'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Teacher'
        ];

        return view('teacher/teacher-list.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            'gender' => 'required',
            'born_date' => 'required|date',
            'phone' => 'required',
            'nik' => 'required|unique:users',
            'address' => 'required',
            'role' => 'required',
        ]);

        $data['password'] = Hash::make($data["password"]);
        User::create($data);

        return redirect()->route('teacher.index')->with('successMessage', 'Add data sukses');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = User::where('id', $id)->where('role', 'Teacher')->first();
        if (!$teacher) {
            return redirect()->route('teacher.index')->with("errorMessage", "Data tidak ditemukan");
        }
        $data = [
            "title" => "Edit Teacher",
            "teacher" => $teacher,
        ];

        return view('teacher/teacher-list.form', compact('teacher'), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:3',
            'gender' => 'required',
            'born_date' => 'required|date',
            'phone' => 'required',
            'nik' => 'required|unique:users,nik,' . $id,
            'address' => 'required',
            'role' => 'required',
        ]);

        try {
            $teacher = User::findOrFail($id);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            } else {
                $data['password'] = $teacher->password;
            }

            $teacher->update($data);

            return redirect()->route('teacher.index')->with('successMessage', 'Edit data sukses');
        } catch (\Throwable $th) {
            return redirect()->route('teacher.edit', $id)->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $teacher = User::where('id', $id)->where('role', 'Teacher')->firstOrFail();
            $teacher->delete();
            return redirect()->route('teacher.index')->with('successMessage', 'Delete data sukses');
        } catch (\Throwable $th) {
            return redirect()->route('teacher.index')->with('errorMessage', $th->getMessage());
        }
    }
}
