<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Menampilkan halaman tambah kategori dan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('admin.settingcategory', compact('categories'));
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('admin.settingcategory')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menghapus kategori dari database
    public function destroy($id)
{
    $category = Category::findOrFail($id);

    // Cek apakah kategori memiliki buku terkait
    if ($category->books()->exists()) {
        return redirect()->route('admin.settingcategory')
            ->with('error', 'Kategori ini memiliki buku terkait dan tidak dapat dihapus.');
    }

    // Jika tidak memiliki buku terkait, lanjutkan penghapusan
    $category->delete();

    return redirect()->route('admin.settingcategory')
        ->with('success', 'Kategori berhasil dihapus.');
}



}
