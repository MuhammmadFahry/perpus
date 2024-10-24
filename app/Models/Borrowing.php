<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'returned_at',
        'status',
        'fine',
        'available'
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    // Relasi ke Buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function hasUnpaidFines($userId)
    {
        return self::where('user_id', $userId)
            ->where('fine', '>', 0)
            ->where('status', '!=', 'returned') // Buku belum dikembalikan
            ->exists();
    }


    public function getDendaAttribute()
    {
        $deadline = $this->returned_at;
        // Pastikan $deadline tidak null
        if (!$deadline) {
            return 0;
        }

        $today = Carbon::now();
        $fine = 0;
        $dendas = Setting::where('key', 'fine_amount')->get();

        // Pastikan mendapatkan nilai denda
        foreach ($dendas as $denda) {
            $fine = $denda->value;
        }

        // Hitung denda jika sudah melewati deadline
        if ($today->greaterThan($deadline)) {
            $lateDays = $today->diffInDays($deadline);
            return $fine + ($fine * (floor(- ($lateDays)) - 1));
        }

        return 0;
    }
}
