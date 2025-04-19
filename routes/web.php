<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    $users = \App\Models\User::all();
    return view('welcome', ['users' => $users]);
});

Route::resource('authors',AuthorController::class);
