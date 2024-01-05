<?php

use App\Http\Controllers\Api\ArtisanController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register/consumer', [RegisterController::class, 'registerConsumer']);
Route::post('/auth/register/deliveryman', [RegisterController::class, 'registerDeliveryMan']);
Route::post('/auth/register/artisan', [RegisterController::class, 'registerArtisan']);

Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/auth/logout', [LoginController::class, 'logout']);
Route::get('/me', [LoginController::class, 'me']);

// PROFILE SECTION
Route::get('/profile/{user}', [ProfileController::class, 'index']);
Route::put('/profile/{user}', [ProfileController::class, 'update']);
Route::delete('/profile/{user}', [ProfileController::class, 'destroy']);
//ARTISAN SECTION

//PRODUCTS SECTION
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/featured', [ProductController::class, 'getFeaturedProducts']);
Route::get('/products/{product}', [ProductController::class, 'show']);

//ORDER SECTION
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{order}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);

//ARTISANS SECTION
Route::get('/artisans', [ArtisanController::class, 'index']);
Route::get('/artisans/{artisan}', [ArtisanController::class, 'show']);
