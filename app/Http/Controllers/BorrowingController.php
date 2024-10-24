<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Historybooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class BorrowingController extends Controller
{
    // Menampilkan daftar buku yang tersedia untuk dipinjam
    public function index()
    {
        $books = Book::where('available', true)->get();
        return view('peminjaman', compact('books'));
    }

    // Proses peminjaman buku
    public function borrow(Request $request, $book_id)
    {
        $user = Auth::user();

        // Cek apakah user memiliki denda yang belum dibayar atau peminjaman yang belum dikembalikan
        $unpaidFines = Borrowing::where('user_id', $user->id)
        // ->where('denda', '>', 0)  // Ada denda yang belum dibayar
        // ->where('status', 'borrowed')  // Status buku belum dikembalikan
        ->get();
        // ->exists();
        foreach ($unpaidFines as $fine) {
            if($fine->denda) {
                return redirect()->back()->with('error', 'Anda tidak dapat meminjam buku karena masih memiliki denda yang belum dibayarkan.');
            }
        }
        // dd('berhasil', $user, $unpaidFines);

        if ($unpaidFines) {
        }

        // Jika tidak ada denda, lanjutkan peminjaman
        $book = Book::findOrFail($book_id);

        if (!$book->available) {
            return redirect()->back()->with('error', 'Buku ini sedang dipinjam.');
        }

        Borrowing::create([
            'user_id' => $user->id,
            'book_id' => $book_id,
            'borrowed_at' => now(),
            'returned_at' => $request->return_date,
            'status' => 'borrowed',
        ]);

        $book->update(['available' => false]);

        return redirect()->back()->with('success', 'Peminjaman buku berhasil.');
    }


    // Menampilkan buku yang dipinjam oleh user yang login
    public function pengembalian()
    {
        $buku_yang_dipinjams = Borrowing::where('user_id', Auth::id())->get();

        return view('pengembalian', [
            'buku_yang_dipinjams' => $buku_yang_dipinjams
        ]);

        return redirect()->back()->with('success', 'Pengembalian buku berhasil.');
    }

    // Proses pengembalian buku atau redirect ke pembayaran jika ada denda
    public function prosesPengembalian(Request $request, $borrowing_id)
    {
        $borrowing = Borrowing::findOrFail($borrowing_id);

        // Cek apakah ada denda
        if ($borrowing->fine > 0) {
            // Redirect ke halaman pembayaran jika ada denda
            return redirect()->route('payment.denda', ['borrowing_id' => $borrowing_id]);
        } else {
            // Jika tidak ada denda, langsung kembalikan buku
            $borrowing->update([
                'status' => 'returned',
                'returned_at' => now(),
            ]);

            $borrowing->book->update(['available' => true]);

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan tanpa denda.');
        }
    }

    // Fungsi pembayaran denda menggunakan Midtrans
    public function payFine($borrowing_id)
    {
        $borrowing = Borrowing::findOrFail($borrowing_id);

        // Cek apakah ada denda
        if ($borrowing->fine > 0) {
            // Konfigurasi Midtrans
            Config::$serverKey = config('MIDTRANS_SERVER_KEY');
            Config::$isProduction = config('MIDTRANS_IS_PRODUCTION');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Buat data transaksi
            $params = [
                'transaction_details' => [
                    'order_id' => uniqid(),
                    'gross_amount' => $borrowing->denda, // Jumlah denda
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];

            try {
                // Buat transaksi menggunakan Snap API Midtrans
                $snapToken = Snap::getSnapToken($params);

                // Pastikan ini mengarah ke view yang benar
                return view('payment', ['snap_token' => $snapToken, 'fine' => $borrowing->denda]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal memproses pembayaran.');
            }
        }

        return redirect()->back()->with('success', 'Tidak ada denda yang harus dibayar.');
    }


    // Fungsi untuk menangani notifikasi dari Midtrans
    public function handleMidtransNotification(Request $request)
    {
        $notification = new \Midtrans\Notification();

        if ($notification->transaction_status == 'settlement') {
            $borrowing = Borrowing::where('id', $notification->order_id)->first();
            if ($borrowing) {
                $borrowing->update(['fine' => 0, 'status' => 'returned']);
                return response()->json(['message' => 'Denda telah lunas dan buku berhasil dikembalikan.']);
            }
        }

        return response()->json(['message' => 'Tidak ada tindakan yang diperlukan.']);
    }

    public function success($id)
    {
        $borrowing = Borrowing::where('id', $id)->where('user_id', Auth::id())->first();

        Historybooks::create([
            'user_id' => Auth::id(),
            'book_id' => $borrowing->book_id,
            'tanggal_dipinjam' => $borrowing->borrowed_at
        ]);

        $borrowing->delete();
        return redirect()->route('Home');
    }
}
