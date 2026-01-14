<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');

    
    Route::get('/', [PostController::class, 'index'])->name('dashboard');

    Route::post('/post', [PostController::class, 'store'])->name('posts.store');

    Route::get('/@{username}/{post:slug}', [PostController::class, 'show'])->name('post.show');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('avatar.destroy');
});

Route::get('/@{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');

require __DIR__.'/auth.php';
