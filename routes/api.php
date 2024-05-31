<?php


use App\Http\Controllers\api\Auth\CustomerController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


function Costumer($controller): void
{
    Route::prefix('/auth')->group(function () use ($controller) {

        Route::post('/reset-password', [EmailController::class, 'resetPassword']);
        Route::post("/reset-password/confirm", [EmailController::class, 'confirmResetPassword']);
        Route::post("/reset-password/check-otp", [EmailController::class, 'checkOtp']);
        Route::post('/login', [$controller, 'login']);
        Route::post('/social-login', [$controller, 'socialLogin']);
        Route::post('/phone-login', [$controller, 'phoneLogin']);
        Route::post('/register', [UserController::class, 'register']);

        Route::middleware('auth:sanctum')->group(function () use ($controller) {
            Route::put('/user/{id}', [UserController::class, 'update']);
            Route::get('/me', [$controller, 'me']);
            Route::get('/delete', [$controller, 'delete']);
            Route::post('/logout', [$controller, 'logout']);
        });
    });
}

Costumer(CustomerController::class);
Route::prefix('/vendor')->group(function () {
    //Costumer(VendorController::class);
});
Route::prefix('/customer')->group(function () {
    Costumer(CustomerController::class);
});
