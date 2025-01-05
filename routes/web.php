<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/home', function() {
    return view('user_layout.home');
})->name('home');
Route::get('/categories/{category}', [CategoryController::class, 'display'])->name('categorized');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
