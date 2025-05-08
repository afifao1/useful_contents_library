<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GenreController;

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('contents', ContentController::class)->only(['index','show']);

Route::get('/categories/{id}/contents', [CategoryController::class, 'contents']);
Route::get('/authors/{id}/contents', [AuthorController::class, 'contents']);
Route::get('/genres/{id}/contents', [GenreController::class, 'contents']);

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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/genres',function(){
        return \App\Models\Genre::all();
    });
});

Route::prefix('v1')->group(base_path('routes/api/v1.php'));

