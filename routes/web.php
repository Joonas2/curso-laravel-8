<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/post', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('post.show');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get( '/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::any('/posts/search', [PostController::class, 'search'])->name('posts.search');

Route::get('/dashboard', function () {     return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
