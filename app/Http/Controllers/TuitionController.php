<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Tuition;
use App\Models\BorrowingBookDetail;
use App\Models\TeacherHomeroomRelationship;
use App\Models\TuitionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TuitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tuitions = Tuition::with(['studentTeacherHomeroomRelationship.student'])->get();
        // dd( $tuitions);
        
        $data = [
            'title' => 'Tuitions',
            'tuitions' => $tuitions,
        ];

        return view('tuition.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::getActiveStudent($this->defaultCurriculum->id);

        // $tuitions = Tuition::with(['tuitionType', 'studentTeacherHomeroomRelationship.student']);
        $tuitions = Tuition::with(['studentTeacherHomeroomRelationship.student'])->get();


        $data = [
            'title' => 'Tuition',
            'tuitions' => $tuitions,
            'students' => $students
        ];

        return view('tuition.tuition_form', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_teacher_homeroom_relationship_id' => 'required',
            'tuition_date' => 'required',
        ]);
        
        // dd($data);

        // Save the validated data into the database
        $tuition = Tuition::create([
            'student_teacher_homeroom_relationship_id' => $data['student_teacher_homeroom_relationship_id'],
            'tuition_date' => $data['tuition_date'],
        ]);

        return redirect('tuition/'.$tuition->id.'/edit')->with('success', 'Checkout book successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tuition = Tuition::findOrFail($id);

        $students = User::getActiveStudent($this->defaultCurriculum->id);

        $tuitionTypes = TuitionType::orderby('name')->get();
        // $now = Carbon::now();

        $data = [
            'title' => 'Tuition Detail',
            'tuition' => $tuition,
            'students' => $students,
            'tuitionTypes' => $tuitionTypes,
            'status' => $tuition->status,
            // 'canBorrow' => $tuition->checkout_date == $now->toDateString()
        ];

        return view('tuition.tuition_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('tuition.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tuition = Tuition::find($id);
        $tuition->delete();

        return redirect()->route('tuition.index')->with('successMessage', 'Tuition Book deleted successfully');
    }

}
