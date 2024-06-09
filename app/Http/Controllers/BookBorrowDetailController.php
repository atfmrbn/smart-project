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
        $message = '';
        $messageType = '';

        try {
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

            BorrowingBookDetail::create($data);
            $message = 'Buku berhasil ditambahkan ke peminjaman.';
            $messageType = 'success';
        } catch (\Illuminate\Validation\ValidationException $e) {
            $message = $e->getMessage();
            $messageType = 'error';
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $messageType = 'error';
        } finally {
            if ($messageType === 'success') {
                return redirect('book-borrow/'.$data['borrowing_book_id'].'/edit')->with($messageType, $message);
            } else {
                return redirect()->back()->with($messageType, $message)->withInput();
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $messageType = '';

        try {
            $borrowDetail = BorrowingBookDetail::find($id);

            if ($borrowDetail) {
                $borrowDetail->delete();
                $message = "Borrowing book ". $borrowDetail->book->title ." deleted successfully.";
                $messageType = "successMessage";
            } else {
                $message = "Borrowing book ". $borrowDetail->book->title ." detail not found.";
                $messageType = "errorMessage";
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $messageType = "errorMessage";
        } finally {
            return redirect()->back()->with($messageType, $message);
        }
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

        //cek jika buku sudah kembali semua
        $borrowingDetails = BorrowingBookDetail::where('borrowing_book_id', $borrowDetail->borrowing_book_id)->get();
        $returnedDetails = BorrowingBookDetail::where([['borrowing_book_id', $borrowDetail->borrowing_book_id], ['penalty', '0']])
        ->whereNotNull('returned_date')->get();
        
        //->get();
        //dd($borrowDetails);
        if($borrowingDetails->count() == $returnedDetails->count())
        { 
            $borrowingBook = BorrowingBook::find($borrowingDetails[0]->borrowing_book_id);
            $borrowingBook->update(['status' => 'returned']);
        }

        // Redirect back to the borrowing book details page
        //TODO buat penalty muncul
        return redirect()->back()->with('success', 'Book returned successfully with a penalty of ');
    }

    public function download($id)
    {
        $borrowDetails = BorrowingBookDetail::with('book')
                       ->where('borrowing_book_id', $id)
                       ->get();

        $borrowingBook = BorrowingBook::find($id);

        $data = [
            'title' => 'Borrowed Books List',
            'borrowDetails' => $borrowDetails,
            'borrowingBook' => $borrowingBook
        ];

        // dd($data);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadview('library.borrow.report-borrow-detail', $data);

	    return $pdf->download('laporan-perpustakaan-pdf');
    }

}
