<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiMiddleware;

// Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
//     // Route::post('login', [AuthController::class, 'login']); (contoh login)

//     Route::group(['middleware' => ApiMiddleware::class], function () {
//         // Route::post('logout', [AuthController::class, 'logout']); (contoh logout)
//     });
// });


Route::post('/users/login', [AuthenticationController::class, 'login'])->name('login')->name('login');


Route::middleware(ApiMiddleware::class)->group(function () {
    Route::get('/users/profile', [ProfileController::class, 'getProfile'])->name('indexProfile');
    Route::post('users/storePhoto',[ProfileController::class, 'storePhotos'])->name('storePhotos');
});

