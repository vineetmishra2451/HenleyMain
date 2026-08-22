<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\OtpLogin;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Storefront Home Placeholder
Route::get('/', function () {
    return view('storefront.placeholder');
})->name('home');

// Guest Storefront Authentication Routes
Route::middleware('guest')->group(function (): void {
    Route::get('/login', Login::class)->name('login');
    Route::get('/login/otp', OtpLogin::class)->name('login.otp');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

// Authenticated Customer Routes
Route::middleware('auth')->group(function (): void {
    Route::post('/logout', LogoutController::class)->name('logout');
    Route::get('/email/verify', VerifyEmail::class)->name('verification.notice');
});

// Signed Email Verification Route
Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Guest Checkout Session Marker (for Phase 09 checkout flow)
Route::post('/guest/continue', function (Request $request) {
    $request->session()->put('checkout.as_guest', true);

    return response()->json(['success' => true, 'guest' => true]);
})->name('guest.continue');

// Living Component Gallery (Guarded to local/staging/testing)
if (app()->environment(['local', 'staging', 'testing'])) {
    Route::get('/design', function () {
        return view('pages.design-gallery');
    })->name('design.gallery');
}
