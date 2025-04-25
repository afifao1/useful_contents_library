<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

//Route::get('/', function () {
//    return view('home');});

Route::get('/',[\App\Http\Controllers\HomeController::class,'home']);

Route::resource('authors',AuthorController::class);

Route::get('/categories', [CategoryController::class,'index' ]);

Route::get('/contents/create', [ContentController::class,'store']);

Route::get('/contents', [ContentController::class,'create']);
