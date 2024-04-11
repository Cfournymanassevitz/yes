<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[UserAuthController::class,'register'])->name('register');
Route::post('login',[UserAuthController::class,'login'])->name('login');

// Routes for ProductController
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store'])->middleware('auth:sanctum');
Route::put('/products/{product}', [ProductController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');

// Routes for StoreController
Route::get('/stores', [StoreController::class, 'index']);
Route::get('/stores/{store}', [StoreController::class, 'show']);
Route::post('/stores', [StoreController::class, 'store'])->middleware('auth:sanctum');
Route::put('/stores/{store}', [StoreController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/stores/{store}', [StoreController::class, 'destroy'])->middleware('auth:sanctum');

// Routes for OrderController
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware('auth:sanctum');
Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::put('/orders/{order}', [OrderController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->middleware('auth:sanctum');

// Routes for UserController
Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('/users/{user}', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::post('/users', [UserController::class, 'store'])->middleware('auth:sanctum');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('logout',[UserAuthController::class,'logout'])->middleware('auth:sanctum');


