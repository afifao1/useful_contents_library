<?php
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {

//    return view('home');
//});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);

//Route::get('/authors', function () {
//    $authors = \App\Models\Author::all();
//    return view('welcome', ['authors' => $authors]);
//});
Route::resource('authors', AuthorController::class);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/contents/create', [ContentController::class, 'store']);
Route::get('/contents', [ContentController::class, 'index']);
