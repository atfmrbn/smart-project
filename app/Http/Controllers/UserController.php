<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderby('name')->get();
        $data = [
            "title" => "Users",
            "users" => $users,
        ];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $data = [
        "title" => "Add User",
    ];

    return view('user.form', $data);
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
        ]);

        $data['password'] = Hash::make($data["password"]);
        User::create($data);

        return redirect('user')->with("successMessage", "Add data sukses");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $data = [
            "title" => "User Detail",
            "user" => $user,
        ];

        return view('user.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect('user')->with("errorMessage", "Data tidak ditemukan");
        }
        $data = [
            "title" => "Edit User",
            "user" => $user,
        ];

        return view('user.form', $data);
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
            'born_date' => 'required',
            'phone' => 'required',
            'nik' => 'required|unique:users,nik,' . $id,
            'address' => 'required',
            'role' => 'required',
        ]);
    
        try {
            $user = User::findOrFail($id); // Gunakan findOrFail untuk memastikan bahwa pengguna ditemukan atau exception
    
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password); // Gunakan request->password langsung
            } else {
                unset($data['password']); // Jangan sertakan password jika tidak diisi
            }
    
            $user->update($data);
    
            return redirect('user')->with("successMessage", "Edit data sukses");
        } catch (\Throwable $th) {
            return redirect('user')->with("errorMessage", $th->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return redirect('user')->with("successMessage", "Delete data sukses");
        } catch (\Throwable $th){
            return redirect('user')->with("errorMessage", $th->getMessage());
        }
    }
}
