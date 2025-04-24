<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

//Route::get('/', function () {
//    return view('home');});

Route::get('/',[\App\Http\Controllers\HomeController::class,'home']);

Route::resource('authors',AuthorController::class);

Route::get('/categories', function (\Illuminate\Http\Request $request) {
    $name = $request->get('name');

    $category = \App\Models\Category::create([
        'name' => $name,
    ]);

    dd($category);
});


