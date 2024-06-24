<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Students';
        $students = User::select('users.*', 'c.name as classroom_name')
            ->join('student_teacher_homeroom_relationships as sthr', 'users.id', '=', 'sthr.student_id')
            ->join('teacher_homeroom_relationships as thr', 'sthr.teacher_homeroom_relationship_id', '=', 'thr.id')
            ->join('classrooms as c', 'thr.classroom_id', '=', 'c.id')
            ->where('role', 'Student')
            ->where('thr.curriculum_id', $this->defaultCurriculum->id);
        $user = Auth::user();
        
        // if ($user->role === 'Teacher'){
        //     $students->where('thr.teacher_id',  $user->id);

        //     $title =  $title  . " in Teacher Homeroom";
        // } else if($user->role === 'Student'){
        //     $classroom = Classroom::select('classrooms.*')
        //     ->join('teacher_homeroom_relationships as thr', 'classrooms.id', '=', 'thr.classroom_id')
        //     ->join('student_teacher_homeroom_relationships as sthr', 'thr.id', '=', 'sthr.teacher_homeroom_relationship_id')
        //     ->join('users as u', 'u.id', '=', 'sthr.student_id')
        //     ->where('u.id', $user->id)
        //     ->where('thr.curriculum_id', $this->defaultCurriculum->id)
        //     ->first();

        //     $students->where('c.id',  $classroom->id);
        // }

        $data = [
            'title' =>  $title ,
            'students' => $students->orderBy('c.name')->orderBy('users.name')->get(),
        ];

        // if($students->isEmpty()) {
        //     // Jika tidak ada data students, pastikan untuk mengembalikan array kosong
        //     $students = [];
        // }

        return view('student/student-list.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Student'
        ];

        return view('student/student-list.student_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'identity_number' => 'required',
        'name' => 'required',
        'username' => 'required|alpha_num|unique:users',
        'email' => 'required|email',
        'password' => 'required|min:3',
        'gender' => 'required',
        'born_date'=> 'required|date',
        'phone'=> 'required|numeric',
        'nik'=> 'required|numeric',
        'address'=> 'required',
        'role' => 'required',
        'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:1024',
    ]);
    $data['password'] = Hash::make($data["password"]);
    // dd($data);


    if ($request->hasFile('image')) {
        try {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error uploading image: ' . $e->getMessage());
        }
    }

    User::create($data);

    return redirect('student/student-list')->with("successMessage", "Add data sukses");
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = User::where('id', $id)->where('role', 'Student')->first();

        $data = [
            'title' => 'Student Detail',
            'student'=> $student,
        ];

        return view('student/student-list.student_detail', compact('student'), $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = User::where('id', $id)->where('role', 'Student')->first();
        if (!$student) {
            return redirect('student/student-list')->with("errorMessage", "Data tidak ditemukan");
        }
        $data = [
            "title" => "Edit Student",
            "student" => $student,
        ];

        return view('student/student-list.student_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'identity_number' => 'required',
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'gender' => 'required',
            'born_date'=> 'required',
            'phone'=> 'required',
            'nik'=> 'required|unique:users,nik,' . $id,
            'address'=> 'required',
            'role' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:1024',
        ]);

        try {
            $student = User::find($id);

            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($student->image && file_exists(public_path('images/' . $student->image))) {
                    unlink(public_path('images/' . $student->image));
                }

                // Upload gambar baru
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image'] = $imageName;
            } else {
                // Tetapkan kembali gambar lama jika tidak ada gambar baru yang diunggah
                $data['image'] = $student->image;
            }

            // Ubah password hanya jika disediakan
            if($request->filled('password')){
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']); // Hapus password dari data jika tidak ada perubahan
            }
            // dd($data);
            // Update data student
            $student->update($data);

            return redirect('student/student-list')->with("successMessage", "Edit data sukses");
        } catch (\Throwable $th) {
            return redirect('student/student-list')->with("errorMessage", $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student = User::where('id', $id)->where('role', 'Student')->first();
            if ($student->image) {
                $imagePath = public_path('images') . '/' . $student->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $student->delete();
            return redirect('student/student-list')->with("successMessage", "Delete data sukses");
        } catch (\Throwable $th){
            return redirect('student/student-list')->with("errorMessage", $th->getMessage());
        }
    }

    public function download()
    {
        $students = User::where('role', 'Student')->get();

        $data = [
            'title' => 'Student List',
            'students' => $students
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('student.student-list.report', $data);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('List-Student.pdf');
    }
}
