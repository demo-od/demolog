<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PublicProfileController;


Route::get('/', function () {
    return view('welcome');
})->middleware('guest');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/api/users/search', function (Request $request) {
        $query = $request->get('q');

        if (!$query)
            return [];

        return User::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('username', 'LIKE', "%{$query}%");
        })
            ->limit(8)
            ->get(['id', 'name', 'username', 'image']); // Only get necessary columns for better performance
    })->name('users.search');
    
    Route::view('/search', 'search')->name('search');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');

    Route::get('/category/{category}', [PostController::class, 'category'])->name('post.byCategory');


    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

    Route::post('/post', [PostController::class, 'store'])->name('posts.store');

    Route::get('/@{username}/{post:slug}', [PostController::class, 'show'])->name('post.show');

    Route::post('/comment/{post}', [PostController::class, 'comment'])->name('post.comment');

    Route::delete('/comment/{comment}', [PostController::class, 'deleteComment'])->name('comment.delete');

    Route::get('/edit/{post:slug}', [PostController::class, 'edit'])->name('post.edit');


    Route::put('/posts/{post}', [PostController::class, 'update'])->name('post.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('avatar.destroy');


    Route::get('/@{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');

    Route::post('/follow/{user:username}', [FollowerController::class, 'followUnfollow'])->name('follow');

    Route::post('/like/{post}', [LikeController::class, 'like'])->name('like');
});


require __DIR__ . '/auth.php';
