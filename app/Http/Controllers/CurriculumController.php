<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculums = Curriculum::all();
        $data = [
            "title" => "Curriculums",
            "curriculums" => $curriculums
        ];

        return view('curriculum.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Add Curriculums",
        ];

        return view('curriculum.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'year.required' => 'Tolong diisi',
            'description.required' => 'Tolong diisi',
        ];

        $data = $request->validate([
            'year' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ], $messages);

        Curriculum::create($data);

        return redirect()->route('curriculum.index')->with('success', 'Curriculum created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curriculum = Curriculum::find($id);
        $data = [
            "title" => "Curriculum Detail",
            "curriculum" => $curriculum,
        ];

        return view('curriculum.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $curriculum = Curriculum::find($id);
        if (!$curriculum) {
            return redirect('curriculum')->with("errorMessage", 'Kategori tidak dapat ditemukan');
        }

        $curriculums = Curriculum::all();

        $data = [
            'title' => 'Edit Curriculum',
            'curriculum' => $curriculum,
            'curriculums' => $curriculums,
        ];

        return view('Curriculum.form', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'year.required' => 'Tolong diisi',
            'description.required' => 'Tolong diisi',
        ];

        $data = $request->validate([
            'year' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ], $messages);

        $curriculum = Curriculum::findOrFail($id); // Mengambil instance model Curriculum berdasarkan $id

        if (!$curriculum) {
            return redirect()->route('curriculum.index')->with('error', 'Curriculum not found.');
        }
        $curriculum->update($data); // Memanggil metode update() pada instance model $curriculum

        return redirect()->route('curriculum.index')->with('success', 'Curriculum updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curriculum = Curriculum::find($id);
        $curriculum->delete();

        return redirect()->route('curriculum.index')->with('success', 'Curriculum deleted successfully.');
    }

    // public function setDefault(string $id)
    // {
    //       try {
    //         DB::beginTransaction();

    //         //update all curriculum is_default to be 0

    //         //update selected curriculum is_default to be 1
    //         $curriculum = Curriculum::find($id);
    //         $curriculum->update(['is_default' => 1]);
            
    
  

    //         DB::commit();
    //         return redirect()->route('patientadmin.index')->with("successMessage", "Tambah data sukses");    
    //     } catch (\Throwable $th) {
    //         DB::rollback();            
    //         return redirect()->route('patientadmin.index')->with("errorMessage", $th->getMessage());
    //     } 
    // }
}
