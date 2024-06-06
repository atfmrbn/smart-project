<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowingBook;
use App\Models\BorrowingBookDetail;
use App\Models\Configuration;
use Carbon\Carbon;

class BookBorrowDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $books = Book::all();
        $borrowDetails = BorrowingBook::with('category')->orderby('name')->get();

        $data = [
            'title' => 'ReceiptDetails',
            'borrowDetails' => $borrowDetails,
            // 'books' => $books
        ];

        return view('library.borrow.borrow_form', $data);
        // return view('borrowDetail.index', $data);
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
        $data = $request->validate([
            'borrowing_book_id' => 'required',
            'book_id' => [
                'required', 'exists:books,id', function ($attribute, $value, $fail) use ($request) {
                $borrowDetailExists = BorrowingBookDetail::where('borrowing_book_id', $request->borrowing_book_id)
                    ->where('book_id', $value)
                    ->exists();

                if ($borrowDetailExists) {
                    $fail('Buku ini sudah dipilih.');
                }
            }],
        ]);

        // $book = Book::findOrFail($data['book_id']);
        BorrowingBookDetail::create($data);

        return redirect('book-borrow/'.$data['borrowing_book_id'].'/edit')->with('error', 'Buku ini sudah dipilih sebelumnya.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $borrowDetail = BorrowingBookDetail::find($id);
        $borrowDetail->delete();

        return redirect()->back();
    }

    public function returnBook(Request $request, string $id)
    {
        $configuration = Configuration::first();
        $borrowDetail = BorrowingBookDetail::with("borrowingBook")->findOrFail($id);

        $now = Carbon::now();
        $borrowDetail->returned_date = $now; // Set the return date to current date

        // Calculate the penalty
        $dueDate = Carbon::parse($borrowDetail->borrowingBook->due_date);
        $diffInDays = $dueDate->diffInDays($now);
        $borrowDetail->penalty = $diffInDays * $configuration->book_penalty;

        $borrowDetail->save();

        // Redirect back to the borrowing book details page
        return redirect()->back()->with('success', 'Book returned successfully with a penalty of ');
    }

    public function download()
    {
        $borrow = BorrowingBook::select('borrowing_books.*', 'users.name', 'classrooms.name as classroom_name')
        ->join('users', 'users.id', '=', 'borrowing_books.student_id')
        ->join('student_teacher_homeroom_relationships', 'users.id', '=', 'student_teacher_homeroom_relationships.student_id')
        ->join('teacher_homeroom_relationships', 'teacher_homeroom_relationships.id', '=', 'student_teacher_homeroom_relationships.teacher_homeroom_relationship_id')
        ->join('classrooms', 'classrooms.id', '=', 'teacher_homeroom_relationships.classroom_id')
        ->where('teacher_homeroom_relationships.curriculum_id', 2)
        ->get();

        $borrowDetails = BorrowingBookDetail::getActiveBorrowingBookDetail($this->defaultCurriculum->id);
        $borrow = BorrowingBook::all();
        $data = [
            'title' => 'Borrowed Books List',
            'borrowDetails' => $borrowDetails,
            'borrow' => $borrow,

        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadview('library.borrow.report-borrow-detail', $data);

	    return $pdf->download('laporan-perpustakaan-pdf');
    }
    
}
