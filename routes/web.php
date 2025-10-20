<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;

Route::get('/', function () {

    $posts = [];
    if (auth()->check()){
        $posts = auth()->user()->userPosts()->latest()->get();
    }
    
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/login', [UserController::class, 'login']);

// Blog post routes
Route::post('/create-post', [PostController::class, 'createPost']);

Route::get('/edit-post/{post}', [PostController::class, 'editPostForm']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);


// Route::get('/all-posts', [PostController::class, 'allPosts']);