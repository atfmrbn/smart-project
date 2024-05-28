<?php

namespace App\Http\Controllers;

use App\Models\ClassroomType;
use Illuminate\Http\Request;


class ClassroomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classroom_types = ClassroomType::orderBy('name')->get();

        $data = [
            'title' => 'Classroom Types',
            'classroom_types' => $classroom_types,
        ];

        // if($students->isEmpty()) {
        //     // Jika tidak ada data students, pastikan untuk mengembalikan array kosong
        //     $students = [];
        // }

        return view('classroom/classroom-type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Classroom Types'
        ];

        return view('classroom/classroom-type.classroom_type_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        ClassroomType::create($data);

        return redirect('classroom/classroom-type')->with("successMessage", "Add data sukses");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom_type = ClassroomType::find($id);

        $data = [
            'title' => 'Classroom Type Detail',
            'classroom_type'=> $classroom_type,
        ];

        return view('classroom/classroom-type.classroom_type_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classroom_type = ClassroomType::find($id);
        if (!$classroom_type) {
            return redirect('classroom/classroom-type')->with("errorMessage", "Data tidak ditemukan");
        }
        $data = [
            "title" => "Edit Classroom Type",
            "classroom_type" => $classroom_type,
        ];

        return view('classroom/classroom-type.classroom_type_form', compact('classroom_type'), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        try {
            $classroom_type = ClassroomType::find($id);

            $classroom_type->update($data);

            return redirect('classroom/classroom-type')->with("successMessage", "Edit data sukses");
        } catch (\Throwable $th) {
            return redirect('classroom/classroom-type')->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $classroom_type = ClassroomType::find($id);
            $classroom_type->delete();
            return redirect('classroom/classroom-type')->with("successMessage", "Delete data sukses");
        } catch (\Throwable $th){
            return redirect('classroom/classroom-type')->with("errorMessage", $th->getMessage());
        }
    }
}
