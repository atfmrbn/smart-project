<?php

namespace App\Http\Controllers;

use App\Models\Tuition;
use App\Models\TuitionDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Midtrans\Config;
use Midtrans\Snap;

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

    public function payOff(Request $request, $id)
    {
        // Load tuition with its relationship to student
        $tuition = Tuition::with('studentTeacherHomeroomRelationship')->findOrFail($id);
        // Validate if student information is available
        if (!$tuition->studentTeacherHomeroomRelationship || !$tuition->studentTeacherHomeroomRelationship->student) {
            return redirect()->back()->with('errorMessage','Informasi siswa tidak tersedia.');
        }

        // Calculate total bill
        $totalBill = $tuition->tuitionDetails()->sum('value');

        // Configure Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false; // Set true for production environment
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Payment parameters
        $params = [
            'transaction_details' => [
                'order_id' => $tuition->id . '-' . time(),
                'gross_amount' => $totalBill,
            ],
            'customer_details' => [
                'first_name' => $tuition->studentTeacherHomeroomRelationship->student->name,
                'last_name' =>  '',
                'email' => $tuition->studentTeacherHomeroomRelationship->student->email,
            ],
        ];

        // dd($params);

        // Get Snap Token from Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Pass data to view
        return view('tuition.tuition_payment', [
            'title' => 'Pembayaran Detail Biaya Sekolah',
            'tuition' => $tuition,
            'totalBill' => $totalBill,
            'snapToken' => $snapToken,
        ]);
    }
    
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $tuition = Tuition::find($request->order_id);
                if ($tuition) {
                    $tuition->update(['status' => 'Paid']);
                    // return $this->invoice($tuition->id);
                } else {
                    dd("Tuition with ID {$request->order_id} not found.");
                }
            } else {
                dd("Transaction status is not 'capture'.");
            }
        } else {
            dd("Signature key does not match.");
        }
    }

    public function invoice($id)
    {
        // Pastikan tuition ditemukan dan memuat relasi tuitionDetails
        $tuition = Tuition::with('tuitionDetails')->find($id);
        // dd($id);
        if (!$tuition) {
            // Jika tuition tidak ditemukan, tampilkan pesan atau redirect ke halaman lain
            return redirect()->back()->withErrors('Transaksi tidak ditemukan.');
        }

        // Hitung total tagihan
        $totalBill = 0;
        foreach ($tuition->tuitionDetails as $tuitionDetail) {
            $totalBill += $tuitionDetail->value;
        }

        $data = [
            'title' => 'Invoice',
            'tuition' => $tuition,
            'totalBill' => $totalBill
        ];

        return view('tuition.invoice', $data);
    }


    // public function invoice($id)
    // {

    //     $tuition = Tuition::find($id);
    //     // Hitung total tagihan
    //     $totalBill = 0;
    //     foreach ($tuition->tuitionDetails as $tuitionDetail) {
    //         $totalBill += $tuitionDetail->value;
    //     }   
    //     $data = ['title' => 'Invoice'];
    //     return view('tuition.invoice', $data, compact('tuition', 'totalBill'));
    // }


}
