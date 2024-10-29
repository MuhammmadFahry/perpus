<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historybooks extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'historybooks';

    // Menentukan field yang bisa diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_dipinjam'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
