<?php

use App\Http\Controllers\api\Auth\CustomerController;
use App\Http\Controllers\api\Auth\KitchenController;
use App\Http\Controllers\api\BannerController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TagController;
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
Route::prefix('/kitchen')->group(function () {
    CrudApi(KitchenController::class);
    route::prefix('/location')->group(function () {
        CrudApi(LocationController::class);
    });
});

Route::prefix('/customer')->group(function () {
    authFunctionApi(CustomerController::class);

});
Route::prefix('/user')->group(function () {
    route::prefix('/location')->group(function () {
        CrudApi(LocationController::class);
    });
    route::prefix('/cart')->group(function () {
        CrudApi(CartController::class);
    });
});

route::prefix('/food')->group(function () {
    CrudApi(FoodController::class);
});
route::prefix('/options')->group(function () {
    CrudApi(OptionController::class);
});
route::prefix('/tag')->group(function () {
    CrudApi(TagController::class);
});route::prefix('/categories')->group(function () {
    CrudApi(CategoryController::class);
});

Route::Resource('banner', BannerController::class);
//payment method url
Route::middleware('auth:sanctum')->group(function (){

    Route::post('/payment/intent', [PaymentController::class, 'createPaymentIntent']);
    Route::post('/webhook/stripe', [PaymentController::class, 'webhook']);

});
    Route::post('/payment/callback', [PaymentController::class, 'webhook']);
Route::get('/home', [HomeController::class, 'index']);
