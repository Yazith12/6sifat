<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/9', function () {
    // return view('welcome');
});

Route::get('/', [PostController::class, 'index']);

Route::get('/post/{slug}', [PostController::class, 'detail'])->name('post.detail');

Route::get('/old-url', [PostController::class, 'oldUrl']);
Route::get('/new-url', [PostController::class, 'newUrl']);

Route::get('/contact', [HomeController::class, 'contactForm'])->name('contact.form');

