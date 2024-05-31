<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\BorrowingBook;
use App\Models\BorrowingBookDetail;
use App\Models\TeacherHomeroomRelationship;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BorrowingBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows = BorrowingBook::getActiveBorrowingBook($this->defaultCurriculum->id);

        $data = [
            'title' => 'Borrowed Books List',
            'borrows' => $borrows 
        ];

        return view('library.borrow.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        $students = User::getActiveStudent($this->defaultCurriculum->id);

        $borrows = BorrowingBook::select('borrowing_books.*', 'users.name', 'classrooms.name as classroom_name')
        ->join('users', 'users.id', '=', 'borrowing_books.student_id')
        ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
        ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
        ->join('classrooms', 'classrooms.id', '=', 'teacher_homeroom_relationships.classroom_id')
        ->where('teacher_homeroom_relationships.curriculum_id', 2)
        ->get();

        $data = [
            'title' => 'Check Out a Book',
            'borrows' => $borrows,
            'students' => $students
        ]; 

        return view('library.borrow.borrow_form', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $messages = [
            'student_id.required' => 'Tolong isi namenya.',
            'description.required' => 'Isi donk description',
            'checkout_date.required' => 'Isi donk description',
            'due_date.required' => 'Isi donk description',
        ]; 

        $data = $request->validate([
            // 'id',
            'student_id' => 'required',
            'description' => 'required',
            'checkout_date' => 'required',
            'due_date' => 'required'
        ], $messages);
        // $data['librarian_id'] = auth()->user()->id;

        // BorrowingBook::create($data);
        $borrowingBook = BorrowingBook::create($data);
        return redirect('book-borrow/'.$borrowingBook->id.'/edit')->with('success', 'Checkout book successfully');
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
        $borrow = BorrowingBook::findOrFail($id);
        
        $students = User::getActiveStudent($this->defaultCurriculum->id);

        $books = Book::with('category')->orderby('title')->get();
        $now = Carbon::now();
        
        $data = [
            'borrow' => $borrow,
            'students' => $students,
            'books' => $books,
            'canBorrow' => $borrow->checkout_date == $now->toDateString()
        ];

        return view('library.borrow.borrow_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('book-borrow.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $borrow = BorrowingBook::find($id);
        $borrow->delete();

        return redirect()->route('book-borrow.index')->with('success', 'Borrow Book deleted successfully');
    }

    public function download()
    {
        $borrows = BorrowingBook::getActiveBorrowingBook($this->defaultCurriculum->id);

        $data = [
            'title' => 'Borrowed Books List',
            'borrows' => $borrows 
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadview('library.borrow.report', $data);

	    return $pdf->download('laporan-perpustakaan-pdf');
    }
}
