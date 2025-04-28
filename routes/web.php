<?php
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);
Route::resource('authors', AuthorController::class);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/contents/create', [ContentController::class, 'store']);
Route::get('/contents', [ContentController::class, 'index']);
Route::get('/contents/{content}', [ContentController::class, 'show']);
