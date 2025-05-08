<?php

use App\Actions\GetAuthors;
use App\Http\Controllers\Api\V1\ContentController;
use Illuminate\Support\Facades\Route;

Route::prefix('/contents')->group(function () {
    Route::get('/', [ContentController::class, 'index']);
    Route::get('/{content}', [ContentController::class, 'show']);
    Route::get('/{content}/authors', fn($content) => (new GetAuthors())($content));
});
