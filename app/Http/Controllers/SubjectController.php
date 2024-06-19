<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\ClassroomType;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('classroomType')->get();
        
        $data = [
            'title' => 'Subjects',
            'subjects' => $subjects,
        ];

        return view('subject.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $classroom_types = ClassroomType::all();

        $data = [
            'title' => 'Add Subject',
            'classroom_types' => $classroom_types,
        ];

        return view('subject.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'classroom_type_id' => 'required|exists:classroom_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Subject::create($data);

        return redirect()->route('subject.index')->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::find($id);

        $data = [
            'title' => 'Detail Subject',
            'subject' => $subject
        ];

        return view('subject.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::find($id);
        if (!$subject) {
            return redirect('subject')->with("errorMessage", 'Subject tidak dapat ditemukan');
        }

        $classroom_types = ClassroomType::all();

        $data = [
            'title' => 'Edit Subject',
            'subject' => $subject,
            'classroom_types' => $classroom_types,
        ];

        return view('subject.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'classroom_type_id' => 'required|exists:classroom_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subject = Subject::findOrFail($id); // Mengambil instance model Subject berdasarkan $id

        if (!$subject) {
            return redirect()->route('subject.index')->with('error', 'Subject not found.');
        }
        $subject->update($data); // Memanggil metode update() pada instance model $subject

        return redirect()->route('subject.index')->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::find($id);
        $subject->delete();

        return redirect()->route('subject.index')->with('success', 'Subject deleted successfully.');
    }
}
