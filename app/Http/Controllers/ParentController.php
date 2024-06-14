<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
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
        $data = [
            'title' => 'Add Parent'
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
            'email' => 'required',
            'password' => 'required|min:3',
            'gender' => 'required',
            'born_date'=> 'required',
            'phone'=> 'required',
            'nik'=> 'required',
            'address'=> 'required',
            'role' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:1024'
        ]);

        $data['password'] = Hash::make($data['password']);

        // Proses unggah gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }   

        // $data['password'] = Hash::make($data["password"]);
        User::create($data);

        return redirect('parent/parent-list')->with("successMessage", "Tambah data parent sukses");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parent = User::where('id', $id)->where('role', 'Parent')->first();

        $data = [
            'title' => 'Parent Detail',
            'parent'=> $parent,
        ];

        return view('parent.detail', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $parent = User::where('id', $id)->where('role', 'Parent')->first();
        if (!$parent) {
            return redirect('parent/parent-list')->with("errorMessage", "Data tidak parent ditemukan");
        }
        $data = [
            "title" => "Edit User",
            "parent" => $parent,
        ];

        return view('parent.form', $data);
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
            'email' => 'required|unique:users,email,' . $id,
            'gender' => 'required',
            'born_date'=> 'required',
            'phone'=> 'required',
            'nik'=> 'required|unique:users,nik,' . $id,
            'address'=> 'required',
            'role' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:1024'
        ]);
        try {
            $parent = User::find($id);

            if($request->hasFile('image')) {
                // cek dulu jika ada gambar maka sebelum di update harus dihapus dulu
                if($parent->image){
                    Storage::delete("public" . $parent->image);
                }

                $data['image'] = $request->file('image')->store('img', 'public');
            } else {
                $data['image'] = $parent->image;
            }

            $parent->update($data);
            
            // if($request->password){
            //     $data['password'] = Hash::make($data["password"]);
            // }else {
            //     $data['password'] = $parent->password;
            // }

            return redirect('parent/parent-list')->with("successMessage", "Edit data " . $parent->name . " sukses");
        } catch (\Throwable $th) {
            return redirect('parent/parent-list')->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $parent = User::where('id', $id)->where('role', 'Parent')->first();
            $parent->delete();
            return redirect('parent/parent-list')->with("successMessage", "Hapus data " . $parent->name . " sukses");
        } catch (\Throwable $th){
            return redirect('parent/parent-list')->with("errorMessage", $th->getMessage());
        }
    }
}
