<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Show the form for editing the profile
    public function edit()
    {
        return view('profile.edit');
    }

    // Update the profile information
    public function update(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate profile picture
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update user data
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update the password only if it is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // // Handle the profile picture upload
        // if ($request->hasFile('profile_picture')) {
        //     // Delete the old profile picture if it exists
        //     if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
        //         Storage::delete('public/' . $user->profile_picture);
        //     }
        //     // Store the new profile picture
        //     $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        //     $user->profile_picture = $path;
        // }

        if ($request->hasFile('profile_picture')) {
            $imageName = time() . "-" . str()->random() . '.' . $request->file('profile_picture')->extension();
                $request->profile_picture->move(public_path('img/profile_pictures'), $imageName);
            $user->profile_picture = 'profile_pictures/'. $imageName;
        }

        // // Save the changes
        $user->save();

        // Redirect back with success message
        return redirect()->route('profile.edit')->with('status', 'Profil berhasil diperbarui!');
        // dd($request->all(), $imageName);
    }
}
