<?php

<<<<<<< HEAD
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
=======
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Models\Category;
use Illuminate\Http\Request;
>>>>>>> ustoz/main
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

//Route::get('/', function () {
<<<<<<< HEAD
//    return view('home');});

Route::get('/',[\App\Http\Controllers\HomeController::class,'home']);

Route::resource('authors',AuthorController::class);

Route::get('/categories', [CategoryController::class,'index' ]);

Route::get('/contents/create', [ContentController::class,'store']);

Route::get('/contents', [ContentController::class,'create']);
=======
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
>>>>>>> ustoz/main
