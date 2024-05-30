<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\User;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extracurriculars = Extracurricular::select('extracurriculars.*')
            ->join('users', 'extracurriculars.id', '=', 'users.id')
            ->where('users.role', 'Student')
            ->orderBy('extracurriculars.id')
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
        ]);

        try {

            Extracurricular::create($data);

            return redirect('extracurricular')->with("successMessage", "Add data sukses");
            
        } catch (\Throwable $th) {
            return redirect('extracurricular')->with("errorMessage", $th->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
