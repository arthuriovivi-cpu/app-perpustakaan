<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;

Route::get('/', function () {
    return view('welcome');
});

// Resource route lengkap (7 route otomatis: index, create, store, show, edit, update, destroy)
Route::resource('books', BookController::class);

// Resource route TANPA method show (6 route)
Route::resource('categories', CategoryController::class)->except(['show']);

// Resource route lengkap (7 route otomatis)
Route::resource('members', MemberController::class);

// Resource route lengkap (7 route) + 1 route custom untuk pengembalian buku
Route::resource('loans', LoanController::class);
Route::patch('/loans/{loan}/kembalikan', [LoanController::class, 'kembalikan'])->name('loans.kembalikan');

// Route group dengan prefix /admin — tugas mandiri Pertemuan 2
Route::prefix('admin')->group(function () {
    Route::get('/info', function () {
        return "Halaman info khusus admin — diakses melalui prefix /admin";
    });
});