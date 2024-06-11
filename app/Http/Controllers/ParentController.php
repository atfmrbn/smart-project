<?php

namespace App\Http\Controllers;

use App\Models\Parent;
use App\Models\User;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
        return view('parents.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'parent_name' => 'required|string|max:255',
            'parent_email' => 'required|string|email|max:255',
        ]);

        Parent::create([
            'user_id'=> $request->user_id,
            'parent_name'=> $request->parent_name,
            'parent_email' => $request->parent_email,
        ]);

        return redirect()->route('dashboard')->with('success', 'Parent information added successfully.');
    }
}
