<?php

namespace App\Http\Controllers;

use App\Models\TuitionType;
use Illuminate\Http\Request;

class TuitionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tuitionTypes = TuitionType::all();
        $data = [
            'title' => 'Tuition Types',
            'tuitionTypes' => $tuitionTypes
        ];

        return view('tuition-type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Tuition Type'
        ];

        return view('tuition-type.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
        ]);

        TuitionType::create($data);

        return redirect()->route('tuition-type.index')->with('success', 'Tuition Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $tuitionType = TuitionType::findOrFail($id);

        $data = [
            'title' => 'Tuition Type Detail',
            'tuitionType' => $tuitionType,
        ];

        return view('tuition-type.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tuitionType = TuitionType::find($id);
        if (!$tuitionType) {
            return redirect()->route('tuition-type.index')->with('error', 'Tuition Type not found');
        }

        $data = [
            'title' => 'Edit Tuition Type',
            'tuitionType' => $tuitionType,
        ];

        return view('tuition-type.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
        ]);

        $tuitionType = TuitionType::find($id);

        if (!$tuitionType) {
            return redirect()->route('tuition-type.index')->with('error', 'Tuition Type not found.');
        }

        $tuitionType->update($data);

        return redirect()->route('tuition-type.index')->with('success', 'Tuition Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tuitionType = TuitionType::find($id);

        if (!$tuitionType) {
            return redirect()->route('tuition-type.index')->with('error', 'Tuition Type not found.');
        }

        $tuitionType->delete();

        return redirect()->route('tuition-type.index')->with('success', 'Tuition Type deleted successfully.');
    }
}
