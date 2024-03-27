<?php

use App\Http\Controllers\Api\ArtisansController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\SocialAuthController;
use App\Http\Controllers\Api\DeliveryManController;
use App\Http\Controllers\Api\DeviceKeyController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register/consumer', [RegisterController::class, 'registerConsumer']);
Route::post('/auth/register/deliveryman', [RegisterController::class, 'registerDeliveryMan']);
Route::post('/auth/register/artisan', [RegisterController::class, 'registerArtisan']);

Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/auth/logout', [LoginController::class, 'logout']);
Route::get('/auth/refresh', [LoginController::class, 'refresh']);
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
Route::put('/orders/{order}', [ArtisansController::class, 'setOrderStatus']);

//ARTISANS
Route::get('/artisans', [ArtisansController::class, 'index']);

//NOTIFICATIONS
Route::post('/notify', [NotificationsController::class, 'notify']);

//device key
Route::post('/device-key', [DeviceKeyController::class, 'save']);

//FIREBASE AUTH
Route::post('/auth/login/google', [SocialAuthController::class, 'loginWithGoogle']);

Route::put('/deliveryMan/status', [LoginController::class, 'setDeliveryManAvailability']);

Route::post('/login/deliveryman', [LoginController::class, 'deliveryManLogin']);

Route::get('/deliveries', [DeliveryManController::class, 'getDeliveries']);

Route::get('/neirest-artisans', [ArtisansController::class, 'getNearestArtisanToUser']);

Route::get('/all-artisans', [ArtisansController::class, 'getAllArtisans']);
