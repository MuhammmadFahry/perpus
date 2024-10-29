<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category'); // Ambil ID kategori dari query string

        // Filter buku berdasarkan kategori jika kategori dipilih
        if ($categoryId) {
            $books = Book::where('category_id', $categoryId)->paginate(8);
        } else {
            $books = Book::paginate(8);
        }

        $categories = Category::all(); // Ambil semua kategori untuk modal

        return view('library', compact('books', 'categories', 'categoryId'));
    }



    // Store new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'category' => 'required',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . "-" . str()->random() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('img/books-cover'), $imageName);
            $imagePath = 'img/books-cover/' . $imageName;
        } else {
            $imagePath = null;
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publication_year' => $request->publication_year,
            'category_id' => $request->category,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.books')->with('success', 'Buku berhasil ditambahkan.');
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
            'category' => 'required',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $imageName = time() . "-" . str()->random() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('img/books-cover'), $imageName);
            $imagePath = 'img/books-cover/' . $imageName;
        } else {
            $imagePath = $book->image;
        }

        $book->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publication_year' => $validated['publication_year'],
            'category_id' => $validated['category'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.books')->with('success', 'Buku berhasil diperbarui.');
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

    // Show a specific book
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('show', compact('book'));
    }

    public function getBooksByCategory($id)
    {
        $books = Book::where('category_id', $id)->get();
        return view('partials.books-list', compact('books'));
    }
}
