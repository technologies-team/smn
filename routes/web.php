<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', array('canLogin' => Route::has('login'), 'canRegister' => Route::has('register'), 'laravelVersion' => Application::VERSION, 'phpVersion' => PHP_VERSION,
    ));
});
Route::get('auth/{provider}', [SocialLoginController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback']);
Route::get('/oauth/login', [OAuthController::class, 'startAuthorization']);
Route::get('/oauth/callback', [OAuthController::class, 'handleRedirect']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
