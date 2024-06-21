<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
    
    public function editProfile()
    {
        $user = Auth::user();

        $data = [
            "title" => "Edit Profile",
            "user" => $user,
        ];

        return view('profile.edit-profile', $data);
    }

    /**
     * Update the profile.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'identity_number' => 'required',
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'gender' => 'required|in:male,female',
            'born_date' => 'required|date',
            'phone' => 'required',
            'nik' => 'required',
            'address' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $user->identity_number = $request->identity_number;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->born_date = $request->born_date;
        $user->phone = $request->phone;
        $user->nik = $request->nik;
        $user->address = $request->address;

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images', 'public');
            $user->image = $filePath;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
  

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.index')->with('successMessage', 'Password updated successfully.');
    }

}

