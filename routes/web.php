<?php

use App\Livewire\CreatePost;
use App\Livewire\EditPost;
use App\Livewire\ListPosts;
use App\Livewire\ShowPost;
use Illuminate\Support\Facades\Route;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/post/create', CreatePost::class)->name('post.create');
    Route::get('/post/{post}/edit', EditPost::class)->name('post.edit');
});

Route::get('/', ListPosts::class)->name('post.index');
Route::get('/post/{post}', ShowPost::class)->name('post.show');

require __DIR__ . '/auth.php';
