<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return 'index page';
})->name('index');

Route::prefix('posts')->as('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'save'])->name('save');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::post('/{post}', [PostController::class, 'update'])->name('update');
    Route::put('/{post}', [PostController::class, 'togglePublish'])->name('togglePublish');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
});
