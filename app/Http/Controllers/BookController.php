<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(8); // Pagination with 8 books per page
        return view('library', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'category' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $book = new Book($request->all());

        if ($request->hasFile('image')) {
            $imageName = time() . "-" . str()->random() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('img/books-cover'), $imageName);
            $book->image = 'img/books-cover/'. $imageName;
        }

        $book->save();

        return redirect()->route('library')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'category' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publication_year = $request->input('publication_year');
        $book->category = $request->input('category');

        if ($request->hasFile('image')) {
            // Delete old image
            $imageName = time() . "-" . str()->random() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('img/books-cover'), $imageName);
            $book->image = 'img/books-cover/'. $imageName;

        }
        // $book->update($request->all());
        $book->save();

        return redirect()->route('library')->with('success', 'Buku berhasil diupdate!');
    }

    public function destroy(Book $book)
    {
        if ($book->image) {
            Storage::delete('public/' . $book->image);
        }

        $book->delete();

        return response()->json(['success' => true, 'message' => 'Buku berhasil dihapus!']);
    }
}
