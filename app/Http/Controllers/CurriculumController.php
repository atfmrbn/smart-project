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

    public function setDefault(string $id)
    {
        try {
            DB::beginTransaction();

            $curriculum = Curriculum::find($id);
            if ($curriculum->is_default) {
                // If the curriculum is already default, set it to 0
                $curriculum->update(['is_default' => 0]);
                $message = "Curriculum unset as default successfully";
            } else {
                // Set all curriculums' is_default to 0
                Curriculum::where('is_default', 1)->update(['is_default' => 0]);

                // Set selected curriculum's is_default to 1
                $curriculum->update(['is_default' => 1]);
                $message = "Curriculum set as default successfully";
            }

            DB::commit();
            return redirect()->route('curriculum.index')->with("successMessage", $message);
        } catch (\Throwable $th) {
            DB::rollback();
            \Log::error($th->getMessage());
            return redirect()->route('curriculum.index')->with("errorMessage", $th->getMessage());
        }
    }
}
