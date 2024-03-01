<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticatingUserController;
use App\Http\Controllers\Api\ApiReservationController;
use App\Http\Controllers\Api\ApiclientCarController;
use App\Http\Controllers\Api\ApiCarController;
use App\Http\Controllers\Api\ApiUserController;

// Public api routes

Route::post('/register', [AuthenticatingUserController::class, 'register']);
Route::post('/login', [AuthenticatingUserController::class, 'login']);
Route::post('/logout', [AuthenticatingUserController::class, 'logout']);
Route::get('/cars', [ApiclientCarController::class, 'index']);
Route::get('/{car_id}', [ApiclientCarController::class, 'show']);




Route::middleware(['auth:sanctum', 'client'])->group(function () {

    
    Route::prefix('reservations')->group(function () {
        Route::get('/user/{user_id}', [ApiReservationController::class, 'showAllByUserId']);
        Route::get('/{reservation_id}', [ApiReservationController::class, 'show']);
        Route::put('/{reservation_id}', [ApiReservationController::class, 'update']);
        Route::delete('/{reservation_id}', [ApiReservationController::class, 'cancel']);
        Route::post('reservations/{car_id}', [ApiReservationController::class, 'store']);
    });


    Route::prefix('users')->group(function () {
        Route::get('/{user_id}', [ApiUserController::class, 'show']);
        Route::put('/{user_id}', [ApiUserController::class, 'update']);
        Route::delete('/{user_id}', [ApiUserController::class, 'destroy']);
    });
});


Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // generate routes for the admin to manage cars, reservations and users
    Route::prefix('admin')->group(function () {

        Route::prefix('cars')->group(function () {
            Route::post('/', [ApiCarController::class, 'store']);
            Route::put('/{car_id}', [ApiCarController::class, 'update']);
            Route::delete('/{car_id}', [ApiCarController::class, 'destroy']);
        });
        Route::prefix('reservations')->group(function () {
            Route::get('/', [ApiReservationController::class, 'showAllReservation']);
            Route::get('/{user_id}', [ApiReservationController::class, 'showAllByUserId']);
            Route::get('/{reservation_id}', [ApiReservationController::class, 'showById']);
            Route::patch('/{reservation_id}', [ApiReservationController::class, 'update']);
            Route::delete('/{reservation_id}', [ApiReservationController::class, 'destroy']);
        });
        Route::prefix('users')->group(function () {
            Route::get('/', [ApiUserController::class, 'index']);
            Route::post('/', [ApiUserController::class, 'store']);
            Route::get('/admins', [ApiUserController::class, 'indexAdmins']);
            Route::get('/all', [ApiUserController::class, 'indexAll']);
            Route::get('/{user_id}', [ApiUserController::class, 'show']);
            Route::put('/{user_id}', [ApiUserController::class, 'update']);
            Route::delete('/{user_id}', [ApiUserController::class, 'destroy']);
        });
    });
});
