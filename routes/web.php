<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


//Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

    Route::post('posts', [PostController::class, 'store'])->name('posts.store');

});

require __DIR__.'/auth.php';
