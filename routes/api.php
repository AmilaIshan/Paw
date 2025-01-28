<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SubscriptionPlanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('products', ProductController::class);
Route::apiResource('admin', AdminController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('user', UserController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('favorite', FavoriteController::class);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('transaction', TransactionController::class);
    Route::apiResource('cart', CartController::class);
    Route::post('/favorites/{productId}', [FavoriteController::class, 'toggle']);
    Route::get('/favorites/{productId}/check', [FavoriteController::class, 'check']);
    
});

Route::apiResource('subscription', SubscriptionPlanController::class);