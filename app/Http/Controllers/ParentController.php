<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = User::where('role', 'Parent')->get();

        $data = [
            'title' => 'Parents',
            'parents' => $parents,
        ];

        // if($parents->isEmpty()) {
        //     // Jika tidak ada data parents, pastikan untuk mengembalikan array kosong
        //     $parents = [];
        // }

        return view('parent.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $data = [
            'title' => 'Add Parent',
            'students' => $students
        ];

        return view('parent.form', $data);
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
            'email' => 'required|email',
            'password' => 'required|min:3',
            'gender' => 'required',
            'born_date'=> 'required|date',
            'phone'=> 'required|numeric',
            'nik'=> 'required|numeric',
            'address'=> 'required',
            'role' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:1024',
            'students' => 'array'
        ]);

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Encrypt password if provided
            $data = $request->except(['password', 'password_confirmation']);
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // Upload image if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image'] = $imageName;
            }

            // Create parent user
            $parent = User::updateOrCreate(['id' => $request->id], $data);

            // Attach students to parent
            if ($request->has('students')) {
                $students = User::whereIn('id', $request->students)->get();
                foreach ($students as $student) {
                    $student->parent_id = $parent->id;
                    $student->save();
                }
            }

            // Commit transaction
            DB::commit();

            return redirect('parent/parent-list')->with("successMessage", "Tambah data parent berhasil.");

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            // Log error if needed or show error message
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $parent = User::with('students')->where('id', $id)->where('role', 'Parent')->first();

        if (!$parent) {
            return redirect('parent/parent-list')->with("errorMessage", "Data parent tidak ditemukan");
        }

        $data = [
            "title" => "Detail Parent",
            "parent" => $parent,
        ];

        return view('parent.detail', $data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $students = User::where('role', 'student')->get();

        // Cari data parent berdasarkan ID dan pastikan rolenya adalah 'Parent'
        $parent = User::with('students')->where('id', $id)->where('role', 'Parent')->first();

        // Jika data parent tidak ditemukan, redirect ke halaman parent-list dengan pesan error
        if (!$parent) {
            return redirect('parent/parent-list')->with("errorMessage", "Data parent tidak ditemukan");
        }

        // Ambil semua ID siswa yang terhubung dengan parent ini
        $selectedStudents = $parent->students->pluck('id')->toArray();

        $data = [
            "title" => "Edit Parent",
            "parent" => $parent,
            "students" => $students,
            "selectedStudents" => $selectedStudents, // Kirimkan ID siswa yang sudah terpilih ke view
        ];

        return view('parent.form', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'identity_number' => 'required',
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $id,
            'email' => 'required|email',
            'password' => 'nullable|min:3',
            'gender' => 'required',
            'born_date'=> 'required|date',
            'phone'=> 'required|numeric',
            'nik'=> 'required|numeric',
            'address'=> 'required',
            'role' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:1024',
            'students' => 'array'
        ]);

        DB::beginTransaction();

        try {
            $parent = User::find($id);

            if (!$parent) {
                return redirect('parent/parent-list')->with("errorMessage", "Data parent tidak ditemukan");
            }

            // Update data parent
            $parent->update($data);

            // Upload gambar profil jika ada
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $parent->image = $imageName;
                $parent->save();
            }

            // Proses student-parent relations (attach/detach)
            if ($request->has('students')) {
                $selectedStudents = $request->input('students');
            } else {
                $selectedStudents = [];
            }

            // Remove parent_id from current students
            User::where('parent_id', $parent->id)->update(['parent_id' => null]);

            // Attach new students to parent
            User::whereIn('id', $selectedStudents)->update(['parent_id' => $parent->id]);

            DB::commit();

            return redirect('parent/parent-list')->with("successMessage", "Update data parent berhasil.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $parent = User::find($id);

            if (!$parent) {
                return redirect('parent/parent-list')->with("errorMessage", "Data parent tidak ditemukan");
            }

            // Set parent_id to null for all students associated with this parent
            User::where('parent_id', $parent->id)->update(['parent_id' => null]);

            // Hapus gambar jika ada
            if ($parent->image) {
                $imagePath = public_path('images') . '/' . $parent->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Delete the parent
            $parent->delete();

            DB::commit();

            return redirect('parent/parent-list')->with("successMessage", "Hapus data parent berhasil.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        }

    }

    public function download()
    {
        $parents = User::where('role', 'Parent')->get();

        $data = [
            'title' => 'Parents List',
            'parents' => $parents
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('parent.report', $data);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('List-Parent.pdf');
    }
}
