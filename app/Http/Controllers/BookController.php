<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Show list of books
    public function index()
    {
        $books = Book::paginate(8);
        return view('library', compact('books'));
    }

    // Store new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'category' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // $imagePath = $request->file('image')->store('book_covers', 'public');
            $imageName = time() . "-" . str()->random() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('img/books-cover'), $imageName);
            $imagePath = 'img/books-cover/'. $imageName;
        } else {
            $imagePath = null;
        }

        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publication_year' => $validated['publication_year'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Show edit form
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // Update book
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'category' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            // $imagePath = $request->file('image')->store('book_covers', 'public');
            $imageName = time() . "-" . str()->random() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('img/books-cover'), $imageName);
            $imagePath = 'img/books-cover/'. $imageName;
        } else {
            $imagePath = $book->image;
        }

        $book->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publication_year' => $validated['publication_year'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    // Delete book
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return back()->with('success', 'Buku berhasil dihapus.');
    }

    public function show($id)
{
    // Cari buku berdasarkan ID
    $book = Book::findOrFail($id);

    // Kirim data buku ke view
    return view('show', compact('book'));
}
}



