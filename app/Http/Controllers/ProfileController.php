<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            "title" => "Profile",
            "user" => $user,
        ];
        return view('profile.index', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'born_date' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        // Update data user
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->born_date = $request->input('born_date');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        // Cek apakah current password sesuai dengan password user yang sedang login
        if (!Hash::check($request->input('current_password'), Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password user
        $user = Auth::user();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    // public function updateImage(Request $request)
    // {
    //     $request->validate([
    //         'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $user = Auth::user();

    //     if ($request->hasFile('profile_picture')) {
    //         // Menghapus foto profil lama jika ada
    //         if ($user->profile_picture && Storage::exists('profile_pictures/' . $user->profile_picture)) {
    //             Storage::delete('profile_pictures/' . $user->profile_picture);
    //         }

    //         // Menyimpan foto profil baru
    //         $fileName = time() . '.' . $request->profile_picture->extension();
    //         $request->profile_picture->storeAs('profile_pictures', $fileName);
    //         $user->profile_picture = $fileName;
    //     }

    //     // Update field lainnya
    //     // $user->field_lain = $request->input('field_lain');

    //     $user->save();

    //     return back()->with('success', 'Profile updated successfully.');
    // }

}
