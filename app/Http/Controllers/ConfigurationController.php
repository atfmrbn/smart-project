<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configurations = Configuration::all();
        $data = [
            "title" => "Configuration",
            "configurations" => $configurations
        ];

        return view('configuration.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Add Configuration",
        ];

        return view('configuration.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'book_penalty' => 'nullable|numeric',
        ]);

        Configuration::create($data);

        return redirect()->route('configuration.index')->with('success', 'Configuration created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $configuration = Configuration::findOrFail($id);
        $data = [
            "title" => "Configuration Detail",
            "configuration" => $configuration
    ];

    return view('configuration.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $configuration = Configuration::find($id);
        if (!$configuration) {
            return redirect('configuration')->with("errorMessage", 'Kurikulum tidak dapat ditemukan');
        }

        $configurations = Configuration::all();

        $data = [
            'title' => 'Edit Configuration',
            'configuration' => $configuration,
            'configurations' => $configurations,
        ];

        return view('configuration.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'book_penalty' => 'nullable|numeric',
        ]);

        $configuration = Configuration::find($id);
        
        if (!$configuration) {
            return redirect()->route('configuration.index')->with('error', 'Configuration not found.');
        }
        $configuration->update($data); // Memanggil metode update() pada instance model $configuration

        return redirect()->route('configuration.index')->with('success', 'Configuration updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $configuration = Configuration::find($id);
        $configuration->delete();

        return redirect()->route('configuration.index')->with('success', 'Configuration deleted successfully.');
    }
}
