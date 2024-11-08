<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
    {
        return view('Home');
    }

    public function search()
    {
        return view('search');
    }

    public function peminjaman()
    {
        return view('peminjaman', [
            'books' => Book::all()
        ]);
    }

    public function profile()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access the profile page.');
        }

        // Jika user ada, kirimkan data ke view
        $nama = $user->name;
        $email = $user->email;

        return view('profile', compact('nama', 'email'));
    }
}
