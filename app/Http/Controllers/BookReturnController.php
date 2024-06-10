<?php

namespace App\Http\Controllers;

use App\Models\BorrowingBook;
use App\Models\BorrowingBookDetail;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $now = Carbon::now()->toDateString();

    $startDate = $request->input("startDate", $now);
    $endDate = $request->input("endDate", $now);

    $filterByDate = BorrowingBook::getInactiveBorrowingBook($this->defaultCurriculum->id, $startDate , $endDate);
    
    // Check if all borrowing books are returned
    $allBooksReturned = true;
    foreach ($filterByDate as $book) {
        if ($book->status !== 'returned') {
            $allBooksReturned = false;
            break;
        }
    }

    // If all books are returned, update their status
    if ($allBooksReturned) {
        foreach ($filterByDate as $book) {
            $borrowingBook = BorrowingBook::find($book->id);
            $borrowingBook->status = 'returned';
            $borrowingBook->save();
        }
    }

    // dd($filterByDate);

    $data = [
        'title' => 'Returned Book List',
        'filterByDate' => $filterByDate,
        'startDate' => $startDate,
        'endDate' => $endDate,
    ];

    return view('library.return.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Return a Book'
        ];

        return view("library.return.return_form", $data);
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
        $message = '';
        $messageType = '';

        try {
            $filter = BorrowingBook::find($id);

            if ($filter) {
                $filter->delete();
                $message = "Book ". $filter->status . " record deleted successfully.";
                $messageType = "successMessage";
            } else {
                $message = "Book ". $filter->status ." borrowing record not found.";
                $messageType = "errorMessage";
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $messageType = "errorMessage";
        } finally {
            return redirect()->route('book-return.index')->with($messageType, $message);
        }
    }

   
    public function downloadPdf(Request $request)
    {
        $curriculumId = $this->defaultCurriculum->id;
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $status = $request->input('status', 'borrowing'); 

        $filterByDate = BorrowingBook::getInactiveBorrowingBook($curriculumId, $startDate, $endDate);
        
        if ($status) {
            $filterByDate->where('status', $status);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadview('library.return.report', compact('filterByDate', 'startDate', 'endDate', 'status'));

        return $pdf->download('book-return-report.pdf');
    }


}