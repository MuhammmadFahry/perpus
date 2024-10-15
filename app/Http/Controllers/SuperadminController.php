<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Ambil data semua admin dan user
        $admins = User::where('role', 'admin')->get();
        $users = User::where('role', 'user')->get();

        // Tampilkan ke view superadmin
        return view('admin.superadmin', compact('admins', 'users'));
    }

    public function addAdmin(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat admin baru
        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin', // Atur role sebagai admin
        ]);

        return redirect()->route('admin.superadmin')->with('success', 'Admin berhasil ditambahkan');
    }
}
