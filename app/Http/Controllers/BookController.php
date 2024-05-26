<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        $data = [
            'title' => 'Books'
        ];

        return view('library.book.index', compact('books'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BookCategory::orderby('name')->get();

        $data = [
            'title' => 'Add Book'
        ];

        return view('library.book.book_form', compact('categories'), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'published_year' => 'required',
            'isbn' => 'required',
            'status' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:1024',
        ]);

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('img', 'public');
        } else {
            $data['image'] = null;
        }

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('images'), $filename);
        //     $data['image'] = $filename;
        // }

        Book::create($data);

        return redirect()->route('book.index')->with('success', 'Book added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = BookCategory::orderBy('name')->get();

        // Array data untuk diteruskan ke view
        $data = [
            'title' => 'Edit Book',
            'book' => $book,  // Mengubah 'menu' menjadi 'book' agar konsisten
            'categories' => $categories,
        ];
        
        return view('library.book.book_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'published_year' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'status' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:1024',
        ]);

        // Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('img', 'public');
        }

        $book->update($data);

        return redirect()->route('book.index')->with('success', 'Book updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    // try{
        $book = Book::find($id);

        if($book->image){
            Storage::delete("public/" .  $book->image);
        }

        $book->delete();
        // Alert::success("Sukses", "Delete data success");
        return redirect('book');

    // } catch(\Throwable $th){
        // Alert::error("Error", $th->getMessage());
        // return redirect('menu');
    // }
    }
}
