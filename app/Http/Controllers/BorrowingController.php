<?php

// BorrowingController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Setting;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function returnBook($id)
    {
        $borrowing = BorrowingController::findOrFail($id);

        // Ambil pengaturan jumlah denda per hari
        $fineAmount = Setting::where('key', 'fine_amount')->value('value');
        
        // Tanggal pengembalian
        $returnedAt = Carbon::now();
        $borrowedAt = Carbon::parse($borrowing->borrowed_at);

        // Misalkan masa pinjam 7 hari
        $allowedDays = 7;

        // Hitung keterlambatan
        $dueDate = $borrowedAt->addDays($allowedDays);
        $lateDays = $returnedAt->diffInDays($dueDate, false); // false untuk menghitung keterlambatan

        // Jika terlambat, hitung denda
        $fine = 0;
        if ($lateDays > 0) {
            $fine = $lateDays * $fineAmount; // Denda dihitung berdasarkan jumlah hari terlambat
        }

        // Update status peminjaman
        $borrowing->update([
            'returned_at' => $returnedAt,
            'fine' => $fine,
            'status' => 'returned',
        ]);

        return redirect()->route('pengembalian')->with('success', 'Buku berhasil dikembalikan. Denda: Rp ' . $fine);
    }
}

