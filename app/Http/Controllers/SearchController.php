<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->input('query');
        
        $books = Book::where(function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%");
            $q->orWhere('author', 'LIKE', "%{$query}%");
        })->get();

        return back()->with('success', $books);
        // dd($request->all(), $books);
    }
}
