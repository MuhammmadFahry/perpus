<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController   extends Controller
{
    // Menampilkan daftar buku yang tersedia untuk dipinjam
    public function index()
    {
        // Menampilkan hanya buku yang available
        $books = Book::where('available', true)->get();
        return view('peminjaman', compact('books'));
    }

    // Proses peminjaman buku
    public function borrow(Request $request, $book_id)
    {
        // Cek apakah buku tersedia
        $book = Book::findOrFail($book_id);
        if (!$book->available) {
            // Redirect dengan pesan error jika buku sedang dipinjam
            return redirect()->back()->with('error', 'Buku ini sedang dipinjam.');
        }

        // Simpan peminjaman
        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book_id,
            'borrowed_at' => now(),
            'returned_at' => $request->return_date,
            'status' => 'borrowed',
            'fine' => 0,
        ]);

        // Update status buku menjadi tidak tersedia
        $book->update(['available' => false]);

        // Redirect dengan pesan sukses jika peminjaman berhasil
        return redirect()->back()->with('success', 'Peminjaman buku berhasil.');
    }

    public function showBorrowedBooks()
{
    $user = Auth::user();
    $borrowedBooks = $user->borrowedBooks;  // Retrieve borrowed books with pivot data

    return view('borrowed-books', compact('borrowedBooks'));
}

}
