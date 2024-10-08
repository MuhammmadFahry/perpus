<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('Home');
})->middleware('auth')->name('Home');

Route::get('/library', [BookController::class, "index"])->name('library');

Route::get('/team', function () {
    return view('team');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, "login"]);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/welcome', [PageController::class, 'welcome'])->name('welcome');
Route::get('/search', [PageController::class, 'search'])->name('search');
Route::get('/peminjaman', [PageController::class, 'peminjaman'])->name('peminjaman');
Route::get('/pengembalian', [PageController::class, 'pengembalian'])->name('pengembalian');
Route::get('/notification', [PageController::class, 'notification'])->name('notification');
Route::get('/profile', [PageController::class, 'profile'])->name('profile')->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/books', [AdminController::class, 'manageBooks'])->name('admin.books');
Route::get('/admin/penalties', [AdminController::class, 'managePenalties'])->name('admin.penalties');
Route::get('/admin/borrow-history', [AdminController::class, 'borrowHistory'])->name('admin.borrowHistory');


Route::middleware('auth')->group(function () {
    // Route for viewing borrowed books
    Route::get('/books/borrowed', [BooksController::class, 'borrowed'])->name('books.borrowed');

    // Route for viewing borrowing history
    Route::get('/books/history', [BooksController::class, 'history'])->name('books.history');

    // Route for editing the profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/books/borrowed', [BooksController::class, 'borrowed'])->name('books.borrowed');
    Route::get('/books/history', [BooksController::class, 'history'])->name('books.history');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::resource('books', BookController::class);

// Route to display notifications for both admin and regular users
Route::middleware('auth')->group(function () {
    Route::get('/notification', [NotificationController::class, 'showNotifications'])->name('notification');
});
