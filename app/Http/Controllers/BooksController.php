<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    // Method to show borrowed books
    public function borrowed()
    {
        //$borrowedBooks = auth()->user()->borrowedBooks; // Assuming the relationship exists
        $id_user = Auth::user()->id;
        return view('borrowed', [
            'borrowedBooks' => Borrowing::where('user_id', $id_user)->get()
        ]);
    }

    // Method to show borrowing history
    public function history()
    {
        $historyBooks = auth()->user()->historyBooks; // Assuming the relationship exists
        return view('history', compact('historyBooks'));
    }

    // Method to show edit profile form
    public function editProfile()
    {
        return view('edit');
    }

    // Method to update profile
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $user->update($request->only('name', 'email', 'address'));

        return redirect()->route('edit')->with('success', 'Profil berhasil diperbarui');
    }
}
