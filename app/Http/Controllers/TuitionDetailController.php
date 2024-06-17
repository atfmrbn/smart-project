<?php

namespace App\Http\Controllers;

use App\Models\Tuition;
use App\Models\TuitionDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TuitionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $books = Book::all();
        $tuitionDetails = TuitionDetail::orderby('name')->get();

        $data = [
            'title' => 'Tuition Detail',
            'tuitionDetails' => $tuitionDetails,
            // 'books' => $books
        ];

        return view('tuition.form', $data);
        // return view('tuitionDetail.index', $data);
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
                'tuition_id' => 'required|exists:tuitions,id',
                'tuition_type_id' => [
                    'required', 
                    'exists:tuition_types,id', 
                    function ($attribute, $value, $fail) use ($request) {
                        $tuitionDetailExists = TuitionDetail::where('tuition_id', $request->tuition_id)
                            ->where('tuition_type_id', $value)
                            ->exists();

                        if ($tuitionDetailExists) {
                            $fail('Tuition type ini sudah dipilih untuk tuition ini.');
                        }
                    }
                ],
                'value' => 'required|numeric',
                'description' => 'required|string|max:255',
            ]);
            // dd($data);
            TuitionDetail::create($data);
            $message = 'Tuition detail berhasil ditambahkan.';
            $messageType = 'successMessage';
        } catch (ValidationException $e) {
            $message = 'Data yang dimasukkan tidak valid.';
            $messageType = 'errorMessage';
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $messageType = 'errorMessage';
        } finally {
            if ($messageType === 'successMessage') {
                return redirect('tuition/' . $data['tuition_id'] . '/edit')->with($messageType, $message);
            } else {
                return redirect()->back()->with($messageType, $message)->withInput();
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tuitionDetail = TuitionDetail::findOrFail($id);
            $tuitionDetail->delete();
            return redirect()->back()->with('successMessage', 'Tuition detail berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', $e->getMessage());
        }
    }


    public function download($id)
    {
        $tuitionDetails = TuitionDetail::with('book')
                       ->where('borrowing_book_id', $id)
                       ->get();

        $borrowingBook = Tuition::find($id);

        $data = [
            'title' => 'Borrowed Books List',
            'tuitionDetails' => $tuitionDetails,
            'borrowingBook' => $borrowingBook
        ];

        // dd($data);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadview('library.borrow.report-borrow-detail', $data);

	    return $pdf->download('laporan-perpustakaan-pdf');
    }
}
