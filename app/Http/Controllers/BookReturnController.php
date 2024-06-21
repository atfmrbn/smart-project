<?php

namespace App\Http\Controllers;

use App\Models\BorrowingBook;
use App\Models\BorrowingBookDetail;
use App\Models\Configuration;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BookReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $configuration = Configuration::first();
        $now = Carbon::now()->toDateString();
        $startDate = $request->input("startDate", $now);
        $endDate = $request->input("endDate", $now);
        $status = $request->input('status', 'borrowing');

        $filters = BorrowingBook::getInactiveBorrowingBook($this->defaultCurriculum->id, $startDate , $endDate);

        // dd($filterByDate);

        $data = [
            'title' => 'Returned Book List',
            'filters' => $filters,
            'configuration' => $configuration,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'status' => $status,
        ];

        // dd($data);

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
        $configuration = Configuration::first();
        $curriculumId = $this->defaultCurriculum->id;
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $status = $request->input('status', ''); 

        $filters = BorrowingBook::getInactiveBorrowingBook($curriculumId, $startDate, $endDate);
        
        if ($status) {
            $filters->where('status', $status);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadview('library.return.report', compact('filters', 'startDate', 'endDate', 'status', 'configuration'))->setPaper('a4', 'landscape');

        return $pdf->download('book-return-report.pdf');
    }

}