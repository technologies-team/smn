<?php

use App\Http\Controllers\api\Auth\AuthKitchenController;
use App\Http\Controllers\api\Auth\CustomerController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\api\BannerController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificatioController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TimeController;
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
            Route::post('/', [$controller, 'store']);
            Route::put('/{id}', [$controller, 'update']);
            Route::delete('/{id}', [$controller, 'delete']);
        });
    }
}

authFunctionApi(CustomerController::class);

Route::prefix('/kitchen')->group(function () {
    authFunctionApi(AuthKitchenController::class);

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
Route::prefix('/feedback')->group(function () {
    CrudApi(FeedBackController::class);

});
Route::prefix('/user')->group(function () {
    route::prefix('/location')->group(function () {
        CrudApi(LocationController::class);
    });
    route::prefix('/cart')->group(function () {
        Route::middleware('auth:sanctum')->post('/add/{id}', [CartController::class, 'addToCart']);
        Route::middleware('auth:sanctum')->get('/view/{id}', [CartController::class, 'viewCart']);
        Route::middleware('auth:sanctum')->delete('/clear/{id}', [CartController::class, 'clearCart']);

    });
});

route::prefix('/food')->group(function () {
    CrudApi(FoodController::class);
});
route::prefix('/order')->group(function () {
    Route::middleware('auth:sanctum')->post('/{id}', [OrderController::class, 'confirmOrder']);
    Route::middleware('auth:sanctum')->get('/view/{id}', [CartController::class, 'show']);
    Route::middleware('auth:sanctum')->delete('/clear/{id}', [CartController::class, 'clearCart']);
});
route::prefix('/options')->group(function () {
    CrudApi(OptionController::class);
});
route::prefix('/setting')->group(function () {
    CrudApi(SettingController::class);
});
route::prefix('/offer')->group(function () {
    CrudApi(OfferController::class);
});
Route::middleware('auth:sanctum')->get('/my-setting', [SettingController::class, 'my_setting']);

route::prefix('/tag')->group(function () {
    CrudApi(TagController::class);
});
route::prefix('/categories')->group(function () {
    CrudApi(CategoryController::class);
});
route::prefix('/attachment')->group(function () {
    CrudApi(AttachmentController::class);

});
route::prefix('/home')->group(function () {
    Route::get('/kitchen', [HomeController::class, 'kitchenHome']);
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/search', [HomeController::class, 'search']);
});
Route::get('/attachment/download/{name}', [AttachmentController::class, 'download']);

Route::Resource('banner', BannerController::class);
//payment method url
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/payment/intent', [PaymentController::class, 'createPaymentIntent']);
    Route::post('/webhook/stripe', [PaymentController::class, 'webhook']);

});
Route::post('/payment/callback', [PaymentController::class, 'webhook']);


Route::prefix('/coupon')->group(function () {
    Route::middleware('auth:sanctum')
        ->group(function () {
            Route::post('/{id}', [CouponController::class, 'apply']);
            Route::post('/remove', [CouponController::class, 'remove']);

        });

});
Route::prefix('/time')->group(function () {

    Route::post('/{id}', [TimeController::class, 'index']);
});Route::prefix('/notification')->group(function () {

    Route::get('/', [NotificationController::class, 'index']);
});

