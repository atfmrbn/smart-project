<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::where('role', 'Student')->get();

        $data = [
            'title' => 'Students'
        ];

        if($students->isEmpty()) {
            // Jika tidak ada data students, pastikan untuk mengembalikan array kosong
            $students = [];
        }

        return view('student/student-teacher-classroom.index', compact('students'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Student'
        ];

        return view('student/student-teacher-classroom.student_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users',
            // 'password' => 'required|min:3',
            'email' => 'required',
            'gender' => 'required',
            'born_date'=> 'required',
            'phone'=> 'required',
            'nik'=> 'required',
            'address'=> 'required',
            'role' => 'required',
        ]);

        // $data['password'] = Hash::make($data["password"]);
        User::create($data);

        return redirect('student/student-teacher-classroom')->with("successMessage", "Add data sukses");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $student = User::where('id', $id)->where('role', 'Student')->first();

        // $data = [
        //     'title' => 'Student Detail',
        //     'student'=> $student,
        // ];

        // return view('student/student-teacher-classroom.student_detail', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = User::where('id', $id)->where('role', 'Student')->first();
        if (!$student) {
            return redirect('student/student-teacher-classroom')->with("errorMessage", "Data tidak ditemukan");
        }
        $data = [
            "title" => "Edit User",
            "student" => $student,
        ];

        return view('student/student-teacher-classroom.student_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $id,
            // 'password' => 'nullable|min:3',
            'email' => 'required|unique:users,email,' . $id,
            'gender' => 'required',
            'born_date'=> 'required',
            'phone'=> 'required',
            'nik'=> 'required|unique:users,nik,' . $id,
            'address'=> 'required',
            'role' => 'required',
        ]);
        try {
            $student = User::find($id);
            
            // if($request->password){
            //     $data['password'] = Hash::make($data["password"]);
            // }else {
            //     $data['password'] = $student->password;
            // }

            $student->update($data);

            return redirect('student/student-teacher-classroom')->with("successMessage", "Edit data sukses");
        } catch (\Throwable $th) {
            return redirect('student/student-teacher-classroom')->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student = User::where('id', $id)->where('role', 'Student')->first();
            $student->delete();
            return redirect('student/student-teacher-classroom')->with("successMessage", "Delete data sukses");
        } catch (\Throwable $th){
            return redirect('student/student-teacher-classroom')->with("errorMessage", $th->getMessage());
        }
    }
}
