<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GenreController;

// Kirilmagan foydalanuvchilar uchun faqat login va register yo‘llari
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Kirgan foydalanuvchilar uchun yo‘llar
Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin panel uchun kontentlar (alohida)
    Route::get('/admin/contents', [ContentController::class, 'adminIndex'])->name('admin.contents');

    // Contents resource, web uchun - nomi "contents.*"


    // Profil sozlamalari
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('contents', ContentController::class);

// Faqat adminlar uchun route’lar (checkadmin middleware bilan)
Route::middleware(['auth', 'checkadmin'])->group(function () {
    Route::resource('authors', AuthorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('genres', GenreController::class);
});

// Auth paketining boshqa marshrutlari (logout va h.k.)
require __DIR__ . '/auth.php';
