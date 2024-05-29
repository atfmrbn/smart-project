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
        $classrooms = Classroom::with('classroom_type')->orderby('id')->get();
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
        $classroom_types = ClassroomType::orderby('name')->get();
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
        ]);

        try {

            Classroom::create($data);

            return redirect('classroom')->with("successMessage", "Add data sukses");
            
        } catch (\Throwable $th) {
            return redirect('classroom')->with("errorMessage", $th->getMessage());

        } finally{
            return redirect('classroom');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom = Classroom::find($id);
        $data = [
            "title" => "Classroom Detail",
            "classroom" => $classroom,
        ];

        return view('classroom.classroom_detail', $data);
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
