<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PDO;

use function Laravel\Prompts\password;

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

    public function forgotPassword()
    {
        $data = [
            "title" => "Confirm Email",
        ];

        return view('auth.forgot-password', $data);
    }

    public function sendEmailReset(Request $request)
    {
        // Validasi input email
        $data = $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Generate token reset password
        $token = Str::random(60);

        // Simpan atau update token di database
        PasswordResetToken::updateOrCreate(
        [
            'email' => $request->email,
        ],
        [
            'token' => $token,
            'created_at' => now()
        ]);

        // Kirim email dengan token reset password
        Mail::to($request->email)->send(new ResetPasswordMail($token));

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('successMessage', 'Link reset password telah dikirim, silakan cek email Anda.');
    }

    public function emailResetPassword(Request $request, $token)
    {
        $getToken = PasswordResetToken::where('token', $token)->first();

        $data = [
            'title' => 'Reset Password',
            // 'getToken' => $getToken
        ];

        if(!$getToken) {
            return redirect()->route('login')->with('errorMessage', "Token tidak valid");
        }

        return view('auth.reset-password', compact('token'), $data);
    }

    // public function ResetPassword(Request $request)
    // {
    //     // Validasi input awal
    //     $request->validate([
    //         'password' => 'required|min:4', // validasi password dan konfirmasi password
    //         'token' => 'required'
    //     ]);
    //     // dd($request->all());

    //     // Cek token reset password
    //     $token = PasswordResetToken::where('token', $request->token)->first();

    //     if (!$token) {
    //         return redirect()->route('login')->with('errorMessage', 'Token tidak valid');
    //     }

    //     // Cek user berdasarkan email yang terkait dengan token
    //     $user = User::where('email', $token->email)->first();
    //     // dd($user);
    //     // Update password user
    //     $user->password = Hash::make($request->password);

    //     // Simpan perubahan password user
    //     $user->save();

    //     // Hapus token reset password setelah berhasil mereset password
    //     $token->delete();

    //     // Redirect dengan pesan sukses
    //     return redirect()->route('login')->with('successMessage', 'Password berhasil direset.');
    // }
    public function ResetPassword(Request $request)
    {
        // Validasi input awal
        $request->validate([
            'password' => 'required|min:4',
            'token' => 'required'
        ]);

        // Cek token reset password
        $token = PasswordResetToken::where('token', $request->token)->first();

        if (!$token) {
            return redirect()->route('login')->with('errorMessage', 'Token tidak valid');
        }

        // Cek user berdasarkan email yang terkait dengan token
        $user = User::where('email', $token->email)->first();

        // Update password user
        $user->password = Hash::make($request->password);

        // Simpan perubahan password user
        $user->save();

        // Hapus token reset password setelah berhasil mereset password
        PasswordResetToken::where('email', $token->email)->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('login')->with('successMessage', 'Password berhasil direset.');
    }



}
