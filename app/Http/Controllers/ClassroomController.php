<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassroomType;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::with('classroomType')->orderBy('id')->get();
        $data = [
            "title" => "Classrooms",
            "classrooms" => $classrooms,
        ];

        return view('classroom.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classroom_types = ClassroomType::orderBy('name')->get();
        $data = [
            "title" => "Add Classroom",
            "classroom_types" => $classroom_types,
        ];

        return view('classroom.classroom_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'classroom_type_id' => 'required|exists:classroom_types,id',
        ]);

        try {
            Classroom::create($data);
            return redirect('classroom')->with("successMessage", "Penambahan data berhasil.");
        } catch (\Throwable $th) {
            return redirect('classroom')->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom = Classroom::find($id);
        $data = [
            "title" => "Detail Classroom",
            "classroom" => $classroom,
        ];

        return view('classroom.classroom_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classroom = Classroom::find($id);
        if (!$classroom) {
            return redirect('classroom')->with("errorMessage", "Data tidak ditemukan");
        }

        $classroom_types = ClassroomType::orderBy('name')->get();

        $data = [
            "title" => "Edit Classroom",
            "classroom" => $classroom,
            "classroom_types" => $classroom_types,
        ];

        return view('classroom.classroom_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'classroom_type_id' => 'required|exists:classroom_types,id',
        ]);

        try {
            $classroom = Classroom::find($id);
            $classroom->update($data);

            return redirect('classroom')->with("successMessage", "Perubahan data berhasil.");
        } catch (\Throwable $th) {
            return redirect('classroom')->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $classroom = Classroom::find($id);
            $classroom->delete();

            return redirect('classroom')->with("successMessage", "Penghapusan data berhasil.");
        } catch (\Throwable $th) {
            return redirect('classroom')->with("errorMessage", $th->getMessage());
        }
    }
}
