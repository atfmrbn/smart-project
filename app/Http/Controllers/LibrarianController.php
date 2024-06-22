<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LibrarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $librarians = User::where('role', 'Librarian')->get();

        $data = [
            'title' => 'Librarians',
            'librarians' => $librarians
        ];

        if ($librarians->isEmpty()) {
            // Jika tidak ada data librarians, pastikan untuk mengembalikan array kosong
            $librarians = [];
        }

        return view('librarian/librarian-list.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Librarian'
        ];

        return view('librarian/librarian-list.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'identity_number' => 'required',
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            'gender' => 'required',
            'born_date' => 'required|date',
            'phone' => 'required',
            'nik' => 'required|unique:users',
            'address' => 'required',
            'role' => 'required',
        ]);

        $data['password'] = Hash::make($data["password"]);
        User::create($data);

        return redirect()->route('librarian.index')->with('successMessage', 'Add data sukses');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $librarian = User::where('id', $id)->where('role', 'Librarian')->first();
        if (!$librarian) {
            return redirect()->route('librarian.index')->with("errorMessage", "Data tidak ditemukan");
        }
        $data = [
            "title" => "Edit Librarian",
            "librarian" => $librarian,
        ];

        return view('librarian/librarian-list.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'identity_number' => 'required',
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:3',
            'gender' => 'required',
            'born_date' => 'required|date',
            'phone' => 'required',
            'nik' => 'required|unique:users,nik,' . $id,
            'address' => 'required',
            'role' => 'required',
        ]);

        try {
            $librarian = User::findOrFail($id);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            } else {
                $data['password'] = $librarian->password;
            }

            $librarian->update($data);

            return redirect()->route('librarian.index')->with('successMessage', 'Edit data sukses');
        } catch (\Throwable $th) {
            return redirect()->route('librarian.edit', $id)->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $librarian = User::where('id', $id)->where('role', 'Librarian')->firstOrFail();
            $librarian->delete();
            return redirect()->route('librarian.index')->with('successMessage', 'Delete data sukses');
        } catch (\Throwable $th) {
            return redirect()->route('librarian.index')->with('errorMessage', $th->getMessage());
        }
    }

    public function download()
    {
        $librarians = User::where('role', 'Librarian')->get();

        $data = [
            'title' => 'Librarians List',
            'librarians' => $librarians
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('librarian.report', $data);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('List-Librarian.pdf');
    }
}
