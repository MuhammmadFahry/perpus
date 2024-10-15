<?php

// app/Http/Controllers/DendaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class DendaController extends Controller
{
    // Menampilkan form pengaturan denda
    public function showFineSettings()
    {
        // Ambil pengaturan jumlah denda saat ini dari tabel 'settings'
        $fineAmount = Setting::where('key', 'fine_amount')->first();
        if(!$fineAmount) return abort(404, 'Data fine amount gak ada fahri, tambahin dulu');
        
        return view('admin.penalties', [
            'fineAmount' => $fineAmount->value
        ]);
    }

    // Menyimpan atau memperbarui pengaturan denda
    public function saveFineSettings(Request $request)
    {
        // Validasi input
        $request->validate([
            'fine_amount' => 'required|numeric|min:0',
        ]);

        try {
            // Simpan atau perbarui pengaturan denda di tabel 'settings'
            Setting::updateOrCreate(
                ['key' => 'fine_amount'], // Mencari pengaturan dengan key "fine_amount"
                ['value' => $request->fine_amount] // Menyimpan atau memperbarui value
            );

            return redirect()->back()->with('success', 'Pengaturan denda berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan pengaturan.');
        }
    }
}

