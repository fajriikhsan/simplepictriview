<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedPostController;

// Route untuk login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route untuk beranda
Route::get('/beranda', [ViewController::class, 'index'])->name('beranda');
Route::post('/upload', [ImageController::class, 'store'])->name('upload.store');
// Rute untuk menghapus postingan
Route::delete('/delete-post/{uploadID}', [ImageController::class, 'destroy'])
    ->middleware('auth')
    ->name('deletePost');



Route::middleware(['auth'])->group(function () {
    Route::post('/toggle-save', [SavedPostController::class, 'toggleSave'])->name('posts.toggle-save');
    Route::get('/check-saved/{upload}', [SavedPostController::class, 'checkSaved'])->name('posts.check-saved');
});

// Menambahkan route untuk halaman profil
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
// routes/web.php
Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');

Route::get('/preview', [ImageController::class, 'preview'])->name('preview');
Route::get('/get-post-owner/{id_post}', [ImageController::class, 'getPostOwner']);

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('login');
});

// Route untuk halaman upload
Route::get('/upload', function () {
    return view('upload');
});
