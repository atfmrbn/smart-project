<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Login",
        ];
        return view("auth.index", $data);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
                'username' => 'required',
                'password' => 'required'
        ]);

        // $data['password'] = Hash::make($request->password);

        if(Auth::attempt($data))
        {
            $request->session()->regenerate();
            return redirect("/");
        }
        return back()->with("errorMessage", "Username atau Password tidak ditemukan");
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
