<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke daftar posts
Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Requirement Poin 1: Route::resource('posts') + named routes
Route::resource('posts', PostController::class);