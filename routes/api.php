<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GenreController;
// use App\Models\Content;

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

// Route::get('/contents', function () {
//     return \App\Models\Content::all();
// });

// Route::get('/contents/{id}', function ($id) {
//     return \App\Models\Content::find($id);
// });

// Route::get('/categories', function () {
//     return \App\Models\Category::all();
// });

// Route::get('/categories/{id}',function($id){
//     return \App\Models\Category::find($id);
// });

// Route::get('/categories/{id}/contents', function($id){
//     return \App\Models\Category::find($id)->contents;
// });

// Route::get('/authors', function () {
//     return \App\Models\Author::all();
// });

// Route::get('/authors/{id}', function($id){
//     return \App\Models\Author::findOrFail($id);
// });

// Route::get('/authors/{id}/contents', function($id){
//     return \App\Models\Author::find($id)->contents;
// });

// Route::get('/genres', function () {
//     return \App\Models\Genre::all();
// });

// Route::get('/genres/{id}', function($id){
//     return \App\Models\Genre::findOrFail($id);
// });

// Route::get('genres/{id}/contents', function($id){
//     return \App\Models\Genre::find($id)->contents;
// });

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/genres',function(){
        return \App\Models\Genre::all();
    });
});

