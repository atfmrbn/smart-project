<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $user = Auth::user();

        return view('profile.edit-profile', ['user' => $user, 'title' => 'Edit Profile']);
    }

    /**
     * Update the profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $user->id,
            'email' => 'required|unique:users,email,' . $user->id,
            'gender' => 'required',
            'born_date' => 'required',
            'phone' => 'required',
            'nik' => 'required|unique:users,nik,' . $user->id,
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
    
            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::delete('images/'.$user->image);
            }
    
            $data['image'] = $imageName;
        }
    
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        $user->update($data);
    
        return redirect()->route('profile.edit-profile')->with('success', 'Profile updated successfully.');
    }    
}

