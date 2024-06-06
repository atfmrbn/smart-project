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
        $extracurricular_students = 
        StudentExtracurricularRelationship::join('users as students', 'student_extracurricular_relationships.student_id', '=', 'students.id')
            ->join('extracurriculars as extra', 'student_extracurricular_relationships.extracurricular_id', '=', 'extra.id')
            ->join('student_teacher_homeroom_relationships as shr', 'students.id', '=', 'shr.student_id')
            ->join('teacher_homeroom_relationships as thr', 'shr.teacher_homeroom_relationship_id', '=', 'thr.id')
            ->join('classrooms as class', 'thr.classroom_id', '=', 'class.id')
            ->select([
                'students.identity_number',
                'class.name as class_name',
                'students.name as student_name',
                'extra.name as extracurricular_name',
                'extra.description as extracurricular_description',
                'student_extracurricular_relationships.id'
            ])
            ->get();
        
            // dd($extracurricular_students);
        
        // StudentExtracurricularRelationship::with(['student', 'extracurricular', 'admin'])
        //     ->orderBy('id')
        //     ->get();

        $data = [
            "title" => "Extracurricular Participants",
            "extracurricular_students" => $extracurricular_students,
        ];

        return view('extracurricular-student.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */

     
     public function create()
     {
         $extracurricular_students = 
             StudentExtracurricularRelationship::join('users as students', 'student_extracurricular_relationships.student_id', '=', 'students.id')
                 ->join('extracurriculars as extra', 'student_extracurricular_relationships.extracurricular_id', '=', 'extra.id')
                 ->join('student_teacher_homeroom_relationships as shr', 'students.id', '=', 'shr.student_id')
                 ->join('teacher_homeroom_relationships as thr', 'shr.teacher_homeroom_relationship_id', '=', 'thr.id')
                 ->join('classrooms as class', 'thr.classroom_id', '=', 'class.id')
                 ->select([
                     'students.identity_number',
                     'class.name as class_name',
                     'students.name as student_name',
                     'extra.name as extracurricular_name',
                     'extra.description as extracurricular_description',
                     'student_extracurricular_relationships.id'
                 ])
                 ->get();
     
         $students = User::select('users.*', 'classrooms.name as class_name', 'users.identity_number')
                         ->where('role', 'Student')
                         ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
                         ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
                         ->join('classrooms', 'teacher_homeroom_relationships.classroom_id', '=', 'classrooms.id')
                         ->get();
     
         $extracurriculars = Extracurricular::orderBy('name')->get();
         $admin = auth()->user();
     
         $data = [
             "title" => "Add Extracurricular Student",
             "students" => $students,
             "extracurricular_students" => $extracurricular_students,
             "extracurriculars" => $extracurriculars,
             "admin" => $admin,
         ];
         
         return view('extracurricular-student.form', $data);
     }
    
    
    public function edit($id)
    {
        $extracurricular_student = StudentExtracurricularRelationship::findOrFail($id);
        $students = User::select('users.*', 'classrooms.name as class_name', 'users.identity_number')
                        ->where('role', 'Student')
                        ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
                        ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
                        ->join('classrooms', 'teacher_homeroom_relationships.classroom_id', '=', 'classrooms.id')
                        ->get();
        $extracurriculars = Extracurricular::orderBy('name')->get();
        $admin = auth()->user(); // Get the logged-in admin user
    
        return view('extracurricular-student.form', [
            'title' => 'Edit Extracurricular Student',
            'extracurricular_student' => $extracurricular_student,
            'students' => $students,
            'extracurriculars' => $extracurriculars,
            'admin' => $admin,
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:users,id',
            'extracurricular_id' => 'required|exists:extracurriculars,id',
            'admin_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        try {
            StudentExtracurricularRelationship::create($data);

            return redirect('extracurricular-student')->with("successMessage", "Add data successful");
        } catch (\Throwable $th) {
            return redirect('extracurricular-student')->with("errorMessage", $th->getMessage());
        }
    }

     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $extracurricular_student = StudentExtracurricularRelationship::join('users as students', 'student_extracurricular_relationships.student_id', '=', 'students.id')
            ->join('extracurriculars as extra', 'student_extracurricular_relationships.extracurricular_id', '=', 'extra.id')
            ->join('student_teacher_homeroom_relationships as shr', 'students.id', '=', 'shr.student_id')
            ->join('teacher_homeroom_relationships as thr', 'shr.teacher_homeroom_relationship_id', '=', 'thr.id')
            ->join('classrooms as class', 'thr.classroom_id', '=', 'class.id')
            ->select([
                'students.identity_number',
                'class.name as class_name',
                'students.name as student_name',
                'extra.name as extracurricular_name',
                'extra.description as extracurricular_description',
                'student_extracurricular_relationships.id'
            ])
            ->where('student_extracurricular_relationships.id', $id)
            ->firstOrFail();
    
        return view('extracurricular-student.detail', [
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
    // public function edit($id)
    // {
    //     $extracurricular_student = StudentExtracurricularRelationship::findOrFail($id);
    //     $students = User::select('users.*', 'teacher_homeroom_relationships.classroom_id', 'users.identity_number')
    //                 ->where('role', 'Student')
    //                 ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
    //                 ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
    //                 ->join('classrooms', 'classrooms.id', '=', 'teacher_homeroom_relationships.classroom_id')
    //                 ->where('teacher_homeroom_relationships.curriculum_id', 2)
    //                 // ->orderBy('users.name')
    //                 ->get();
    //     $extracurriculars = Extracurricular::orderBy('name')->get();
    //     $admins = User::where('role', 'Admin')->orderBy('name')->get();

    //     return view('extracurricular-student.form', [
    //         'title' => 'Edit Extracurricular Student',
    //         'extracurricular_student' => $extracurricular_student,
    //         'students' => $students,
    //         'extracurriculars' => $extracurriculars,
    //         'admins' => $admins,
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:users,id',
            'extracurricular_id' => 'required|exists:extracurriculars,id',
            'admin_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        try {
            $extracurricular_student = StudentExtracurricularRelationship::findOrFail($id);
            $extracurricular_student->update($data);

            return redirect('extracurricular-student')->with('successMessage', 'Data successfully updated');
        } catch (\Throwable $th) {
            return redirect('extracurricular-student', $id)->with('errorMessage', $th->getMessage());
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

            return redirect('extracurricular-student')->with('successMessage', 'Data successfully deleted');
        } catch (\Throwable $th) {
            return redirect('extracurricular-student')->with('errorMessage', $th->getMessage());
        }
    }
}
