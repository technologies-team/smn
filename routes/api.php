<?php

use App\Http\Controllers\api\Auth\CustomerController;
use App\Http\Controllers\api\Auth\KitchenController;
use App\Http\Controllers\api\BannerController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;


if (!function_exists('authFunctionApi')) {
    function authFunctionApi($controller): void
    {
        Route::prefix('/auth')->group(function () use ($controller) {
            Route::post('/reset-password', [EmailController::class, 'resetPassword']);
            Route::post("/reset-password/confirm", [EmailController::class, 'confirmResetPassword']);
            Route::post("/reset-password/check-otp", [EmailController::class, 'checkOtp']);
            Route::post('/login', [$controller, 'login']);
            Route::post('/social-login', [$controller, 'socialLogin']);
            Route::post('/register', [$controller, 'register']);

            Route::middleware('auth:sanctum')->group(function () use ($controller) {
                Route::put('/user/{id}', [UserController::class, 'update']);
                Route::get('/me', [$controller, 'me']);
                Route::get('/delete', [$controller, 'delete']);
                Route::post('/logout', [$controller, 'logout']);
            });
        });
    }
}

if (!function_exists('CrudApi')) {
    function CrudApi($controller): void
    {
        Route::get('/', [$controller, 'index']);
        Route::get('/{id}', [$controller, 'show']);

        Route::middleware('auth:sanctum')->group(function () use ($controller) {
            Route::post('/', [$controller, 'storeAll']);
            Route::put('/{id}', [$controller, 'updateAll']);
            Route::delete('/{id}', [$controller, 'destroy']);
        });
    }
}

authFunctionApi(CustomerController::class);

Route::prefix('/kitchen')->group(function () {
    authFunctionApi(KitchenController::class);
});

Route::prefix('/customer')->group(function () {
    authFunctionApi(CustomerController::class);
});
route::prefix('/food')->group(function () {
    CrudApi(FoodController::class);
});
Route::Resource('banner', BannerController::class);
