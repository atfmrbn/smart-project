<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extracurriculars = Extracurricular::orderBy('name')->get();

        $data = [
            'title' => 'Extracurriculars',
            'extracurriculars' => $extracurriculars,
        ];

        return view('extracurricular.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Extracurricular'
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
            'description' => 'required',
        ]);

        Extracurricular::create($data);

        return redirect('extracurricular')->with("successMessage", "Add data sukses");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $extracurricular = Extracurricular::find($id);

        $data = [
            'title' => 'Extracurricular Detail',
            'extracurricular'=> $extracurricular,
        ];

        return view('extracurricular.extracurricular_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $extracurricular = Extracurricular::find($id);
        if (!$extracurricular) {
            return redirect('extracurricular')->with("errorMessage", "Data tidak ditemukan");
        }
        $data = [
            "title" => "Edit Extracurricular",
            "extracurricular" => $extracurricular,
        ];

        return view('extracurricular.extracurricular_form', compact('extracurricular'), $data);
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
            $extracurricular = Extracurricular::find($id);

            $extracurricular->update($data);

            return redirect('extracurricular')->with("successMessage", "Edit data sukses");
        } catch (\Throwable $th) {
            return redirect('extracurricular')->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $extracurricular = Extracurricular::find($id);
            $extracurricular->delete();
            return redirect('extracurricular')->with("successMessage", "Delete data sukses");
        } catch (\Throwable $th){
            return redirect('extracurricular')->with("errorMessage", $th->getMessage());
        }
    }
}
