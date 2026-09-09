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
use App\Livewire\Storefront\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Storefront Home
Route::get('/', HomePage::class)->name('home');

// Storefront Browse & Content Fallbacks (for Phase 05 link integrity)
Route::get('/collections/{slug?}', function (?string $slug = null) {
    return redirect()->route('home');
})->name('collections.index');

Route::get('/products/{slug}', function (string $slug) {
    return redirect()->route('home');
})->name('products.show');

Route::get('/about', function () {
    return redirect()->route('home');
})->name('about');

Route::get('/journal/{slug?}', function (?string $slug = null) {
    return redirect()->route('home');
})->name('journal.index');

Route::get('/cart', function () {
    return redirect()->route('home');
})->name('cart');

// Admin & Vendor Panel Subdomain Shortcuts
Route::get('/admin', function () {
    return redirect('http://' . config('domains.admin', 'admin.henley.com'));
})->name('admin.redirect');

Route::get('/vendor', function () {
    return redirect('http://' . config('domains.vendor', 'vendor.henley.com'));
})->name('vendor.redirect');

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
