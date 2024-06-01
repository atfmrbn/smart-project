<?php

namespace App\Http\Controllers;

use App\Models\StudentExtracurricularRelationship;
use Illuminate\Http\Request;

class StudentExtracurricularRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extracurricular_students = StudentExtracurricularRelationship::with(['student', 'extracurricular', 'admin'])
        ->orderBy('id')
        ->get();

        $data = [
            "title" => "Extracurricular Participants",
            "extracurricular_students" => $extracurricular_students,
        ];

        return view('extracurricular/extracurricular-student-relationship.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
