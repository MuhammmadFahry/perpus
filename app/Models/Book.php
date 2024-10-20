<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'category',
        'description',
        'image'
    ];

    public function borrowers()
    {
        return $this->belongsToMany(User::class, 'borrowing', 'book_id', 'user_id')
            ->withPivot('borrowed_at', 'returned_at')
            ->withTimestamps();
    }

    public function historybooks()
    {
        return $this->hasMany(Historybooks::class, 'book_id');
    }
}
