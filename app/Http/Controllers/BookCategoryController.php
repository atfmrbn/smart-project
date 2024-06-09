<?php

namespace App\Http\Controllers;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BookCategory::all();

        $data = [
            'title' => 'Book Categories'
        ];

        return view('library.book-category.index', compact('categories'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('library.book-category.category_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Tolong isi namenya.',
            'description.required' => 'Isi donk description',
        ]; 

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ], $messages);

        BookCategory::create($data);          
        return redirect()->route('book-category.index')->with('successMessage', 'Kategori berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = BookCategory::findOrFail($id);

        return view('library.book-category.category_form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'name.required' => 'Name is required.',
            'description.required' => 'description is required.',
        ]; 

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ], $messages);

        // try {
        $category = BookCategory::find($id);

        $category->update($data);

            // return redirect('category');
        // } catch (\Throwable $th) {
            return redirect()->route('book-category.index')->with('successMessage', 'Kategori buku '. $category->name .' berhasil diedit');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = BookCategory::find($id);
        $category->delete();

        return redirect()->route('book-category.index')->with('successMessage', 'Kategori buku '. $category->name .' berhasil dihapus');
    }
}
