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
    return $this->belongsToMany(User::class, 'borrowings')
                ->withPivot('borrowed_at', 'return_by')
                ->withTimestamps();
}

}
