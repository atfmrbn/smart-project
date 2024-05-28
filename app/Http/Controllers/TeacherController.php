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
    $users = User::orderBy('name')->get();
    return view('teacher.teacher-list.index', compact('users'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Add Teachers"
        ];

        return view('teacher.teacher-list.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users',
            'password' => 'required|min:3',
            'gender.required' => 'required',
            'born-date.required' => 'required',
            'phone.required' => 'required',
            'nik.required' => 'required',
            'address.required' => 'required',
        ]);

        $data['password'] = Hash::make($data["password"]);
        User::create($data);

        return redirect('teacher/teacher-list')->with("successMessage", "Add data success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = User::find($id);
        $data = [
            "title" => "Teacher Detail",
            "teacher" => $teacher,
        ];

        return view('teacher.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = User::find($id);
        if (!$teacher) {
            return redirect('teacher')->with("errorMessage", "Teacher tidak ditemukan");
        }
        $data = [
            "title" => "Edit Teachers",
            "teacher" => $teacher
        ];

        return view('teacher.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'name.required' => 'Tolong isi namanya.',
            'username.required' => 'Tolong isi usernamenya.',
            'username.unique' => 'Tolong isi username yang unik.',
            'password.min' => 'Password minimal 3 karakter.',
            'role.required' => 'Pilih Role.',
        ];

        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $id,
            'password' => 'nullable|min:3',
            'role' => 'required'
        ], $messages);

        try {
            $teacher = User::find($id);
            if ($request->filled('password')) {
                $data['password'] = Hash::make($data["password"]);
            } else {
                unset($data['password']);
            }

            $teacher->update($data);

            return redirect('teacher')->with("successMessage", "Edit data success");
        } catch (\Throwable $th) {
            return redirect('teacher')->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $teacher = User::find($id);
            $teacher->delete();
            return redirect('teacher')->with("successMessage", "Delete data success");
        } catch (\Throwable $th) {
            return redirect('teacher')->with("errorMessage", $th->getMessage());
        }
    }
}
