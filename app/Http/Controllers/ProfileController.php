<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Show the profile edit page
    public function edit()
    {
        return view('profile.edit');
    }

    // Update profile data
    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update($request->only('name', 'email', 'address'));

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui');
    }
}
