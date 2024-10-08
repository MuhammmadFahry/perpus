<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'publication_year' => 'required|numeric',
        'category' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
    ]);

    $book = new Book();
    $book->title = $request->title;
    $book->author = $request->author;
    $book->publication_year = $request->publication_year;
    $book->category = $request->category;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('books', 'public');
        $book->image = $imagePath;
    }

    $book->save();

    return response()->json([
        'success' => true,
        'book' => $book,
    ]);
}

public function destroy($id)
{
    $book = Book::find($id);

    if ($book) {
        if ($book->image) {
            Storage::disk('public')->delete($book->image); // Delete image from storage
        }
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus.',
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Buku tidak ditemukan.',
        ]);
    }
}
