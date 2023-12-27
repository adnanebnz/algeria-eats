<?php

use Illuminate\Support\Facades\Route;

Route::post('/auth/register/consumer', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'registerConsumer']);
Route::post('/auth/register/deliveryman', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'registerDeliveryMan']);
Route::post('/auth/register/artisan', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'registerArtisan']);

Route::post('/auth/login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login']);
Route::post('/auth/logout', [\App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);
//WE NEED TO SEND THE TOKEN IN THE HEADER
Route::get('/me', [\App\Http\Controllers\Api\Auth\LoginController::class, 'me']);
// PROFILE SECTION
Route::get('/profile/{user}', [\App\Http\Controllers\Api\Profile\ProfileController::class, 'index']);
Route::put('/profile/{user}', [\App\Http\Controllers\Api\Profile\ProfileController::class, 'update']);
Route::delete('/profile/{user}', [\App\Http\Controllers\Api\Profile\ProfileController::class, 'destroy']);
//ARTISAN SECTION
