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
        $status = $request->input('status', 'borrowing');

        $filters = BorrowingBook::getInactiveBorrowingBook($this->defaultCurriculum->id, $startDate , $endDate);
        
        

        // dd($filterByDate);

        $data = [
            'title' => 'Returned Book List',
            'filters' => $filters,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'status' => $status,
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
        $status = $request->input('status', ''); 

        $filters = BorrowingBook::getInactiveBorrowingBook($curriculumId, $startDate, $endDate);
        
        if ($status) {
            $filters->where('status', $status);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadview('library.return.report', compact('filters', 'startDate', 'endDate', 'status'));

        return $pdf->download('book-return-report.pdf');
    }


}