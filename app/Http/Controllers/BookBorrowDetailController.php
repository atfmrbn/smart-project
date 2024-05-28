<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowingBook;
use App\Models\BorrowingBookDetail;

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
        // Validasi input
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
}
