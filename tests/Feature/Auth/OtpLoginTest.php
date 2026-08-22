<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Livewire\Auth\OtpLogin;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

test('otp login dispatches hashed code with 5-minute expiry', function (): void {
    Config::set('henley.auth.otp_enabled', true);

    Livewire::test(OtpLogin::class)
        ->set('phone', '+919820099887')
        ->call('sendOtp')
        ->assertSet('codeSent', true);

    $otpRecord = OtpCode::where('identifier', '+919820099887')->firstOrFail();
    expect($otpRecord->code)->not->toBeEmpty()
        ->and($otpRecord->expires_at->isFuture())->toBeTrue()
        ->and($otpRecord->attempts)->toBe(0);
});

test('otp login rejects invalid code and increments attempt counter', function (): void {
    Config::set('henley.auth.otp_enabled', true);

    $phone = '+919820099887';
    OtpCode::create([
        'identifier' => $phone,
        'code' => Hash::make('654321'),
        'type' => 'login',
        'expires_at' => now()->addMinutes(5),
        'attempts' => 0,
    ]);

    Livewire::test(OtpLogin::class)
        ->set('phone', $phone)
        ->set('codeSent', true)
        ->set('code', '111111')
        ->call('verifyOtp')
        ->assertHasErrors(['code']);

    $otpRecord = OtpCode::where('identifier', $phone)->firstOrFail();
    expect($otpRecord->attempts)->toBe(1);
});

test('otp login rejects expired code', function (): void {
    Config::set('henley.auth.otp_enabled', true);

    $phone = '+919820099887';
    OtpCode::create([
        'identifier' => $phone,
        'code' => Hash::make('654321'),
        'type' => 'login',
        'expires_at' => now()->subMinutes(1), // Expired
        'attempts' => 0,
    ]);

    Livewire::test(OtpLogin::class)
        ->set('phone', $phone)
        ->set('codeSent', true)
        ->set('code', '654321')
        ->call('verifyOtp')
        ->assertHasErrors(['code']);
});

test('otp login exhausts and deletes code after 3 failed attempts', function (): void {
    Config::set('henley.auth.otp_enabled', true);

    $phone = '+919820099887';
    OtpCode::create([
        'identifier' => $phone,
        'code' => Hash::make('654321'),
        'type' => 'login',
        'expires_at' => now()->addMinutes(5),
        'attempts' => 3, // Exhausted
    ]);

    Livewire::test(OtpLogin::class)
        ->set('phone', $phone)
        ->set('codeSent', true)
        ->set('code', '654321')
        ->call('verifyOtp')
        ->assertHasErrors(['code']);

    expect(OtpCode::where('identifier', $phone)->exists())->toBeFalse();
});

test('otp login successfully logs in user with valid code and marks code verified', function (): void {
    Config::set('henley.auth.otp_enabled', true);

    $user = User::where('role', \App\Enums\UserRole::CUSTOMER)->whereNotNull('phone')->firstOrFail();
    $phone = (string) $user->phone;

    OtpCode::create([
        'identifier' => $phone,
        'code' => Hash::make('849201'),
        'type' => 'login',
        'expires_at' => now()->addMinutes(5),
        'attempts' => 0,
    ]);

    Livewire::test(OtpLogin::class)
        ->set('phone', $phone)
        ->set('codeSent', true)
        ->set('code', '849201')
        ->call('verifyOtp')
        ->assertRedirect('/');

    expect(Auth::check())->toBeTrue()
        ->and(Auth::id())->toBe($user->id);

    $otpRecord = OtpCode::where('identifier', $phone)->firstOrFail();
    expect($otpRecord->verified_at)->not->toBeNull();
});
