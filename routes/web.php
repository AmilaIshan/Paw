<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('user_layout.home');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::get('/home', function() {
//     return view('user_layout.home');
// })->name('home');

Route::get('/categories/{category}', [CategoryController::class, 'display'])->name('categorized');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/aboutUs', function() {
    return view('user_layout.aboutUs');
})->name('aboutUs');
Route::get('/cart', [CartController::class, 'cartPage'])->name('cart');

Route::get('/testing', function() {
    return view('categories.newIndex');
})->name('testing');

Route::get('/category/{id}', [CategoryController::class, 'getProducts'])->name('category.show');