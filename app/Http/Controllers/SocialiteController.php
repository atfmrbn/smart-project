<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // Google user object dari google
        $userFromGoogle = Socialite::driver('google')->user();

        // Ambil user dari database berdasarkan email
        $userFromDatabase = User::where('email', $userFromGoogle->getEmail())->first();

        // Jika tidak ada user dengan email tersebut, tolak akses
        if (!$userFromDatabase) {
            return redirect('/')->with('errorMessage', 'Email tidak terdaftar.');
        }

        // Jika user dengan email tersebut sudah ada, update google_id jika perlu
        $userFromDatabase->google_id = $userFromGoogle->getId();
        $userFromDatabase->save();

        // Login user yang ada
        auth('web')->login($userFromDatabase);
        session()->regenerate();

        return redirect('/');
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
