<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\ConsumerController;
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

//Consumer SECTION
Route::get('/consumer/orders', [ConsumerController::class, 'ordersIndex']);
Route::get('/consumer/orders/{order}', [ConsumerController::class, 'ordersShow']);
