<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Book; // Pastikan model Book diimpor
use App\Models\Borrow; // Pastikan model Borrow diimpor
use App\Models\Historybooks;
use App\Models\Penalty; // Pastikan model Penalty diimpor

class AdminController extends Controller
{
    // Mengelola Buku
    public function manageBooks()
    {
        // Mengambil semua buku dari database
        $books = Book::paginate(10); // Pastikan model Book sudah dibuat
        $categories = Category::all();
        return view('admin.books', data: compact('books', 'categories'));
    }

    // Mengelola Denda
    public function managePenalties()
    {
        // Mengambil semua denda dari database
        $penalties = Penalty::all(); // Pastikan model Penalty sudah dibuat
        return view('admin.penalties', compact('penalties'));
    }

    // Melihat Riwayat Peminjaman
    public function borrowHistory()
    {
        // Mengambil riwayat peminjaman dengan relasi ke user dan buku
        $borrowHistory = Borrow::with('user', 'book')->get(); // Pastikan relasi ini sudah ada di model Borrow
        return view('admin.borrowHistory', compact('borrowHistory'));
    }

    // Halaman Dashboard Admin
    public function index()
    {
        return view('admin.index');
    }

    public function exportPdf()
    {
        // Ambil data history
        $historysemuanya = Historybooks::with(['book', 'user'])->get();

        // Generate view untuk PDF
        $pdf = Pdf::loadView('pdf.laporan', compact('historysemuanya'));

        // Return PDF
        return $pdf->download('history_buku.pdf');
    }
}
