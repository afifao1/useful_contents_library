<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GenreController;

// API faqat index va show uchun, lekin nomlar boshqacha bo‘lsin
Route::apiResource('categories', CategoryController::class)
    ->only(['index', 'show'])
    ->names([
        'index' => 'api.categories.index',
        'show' => 'api.categories.show',
    ]);

Route::apiResource('authors', AuthorController::class)
    ->only(['index', 'show'])
    ->names([
        'index' => 'api.authors.index',
        'show' => 'api.authors.show',
    ]);

Route::apiResource('genres', GenreController::class)
    ->only(['index', 'show'])
    ->names([
        'index' => 'api.genres.index',
        'show' => 'api.genres.show',
    ]);

Route::apiResource('contents', ContentController::class)
    ->only(['index', 'show'])
    ->names([
        'index' => 'api.contents.index',
        'show' => 'api.contents.show',
    ]);

// Maxsus filtrlar
Route::get('/categories/{id}/contents', [CategoryController::class, 'contents'])->name('api.categories.contents');
Route::get('/authors/{id}/contents', [AuthorController::class, 'contents'])->name('api.authors.contents');
Route::get('/genres/{id}/contents', [GenreController::class, 'contents'])->name('api.genres.contents');

// Foydalanuvchi ro'yxatdan o'tish va token yaratish
Route::post('/tokens/create', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    $token = $user->createToken($validated['name']);

    return response()->json([
        'user' => $user->name,
        'token' => $token->plainTextToken,
    ]);
});

// Authenticated foydalanuvchilar uchun
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Qo'shimcha autentifikatsiyalangan API yo'llari, misol uchun:
    Route::get('/genres', function () {
        return \App\Models\Genre::all();
    });
});

// Versioning uchun misol (agar kerak bo'lsa)
Route::prefix('v1')->group(base_path('routes/api/v1.php'));
