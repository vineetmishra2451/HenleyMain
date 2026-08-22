<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Enums\UserRole;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Mail\ResetPasswordMailable;
use App\Mail\VerifyEmailMailable;
use App\Mail\WelcomeCustomerMailable;
use App\Models\Customer;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;

test('customer can register with valid details and strong password', function (): void {
    Mail::fake();

    Livewire::test(Register::class)
        ->set('name', 'Priya Sharma')
        ->set('email', 'priya.sharma@example.com')
        ->set('phone', '+919810011223')
        ->set('password', 'Botanical#2026!Secure')
        ->set('password_confirmation', 'Botanical#2026!Secure')
        ->set('accept_terms', true)
        ->call('register')
        ->assertRedirect('/');

    $user = User::where('email', 'priya.sharma@example.com')->firstOrFail();
    expect($user->role)->toBe(UserRole::CUSTOMER)
        ->and($user->hasRole('customer'))->toBeTrue()
        ->and(Auth::id())->toBe($user->id);

    // Profile and Wishlist created
    expect(Customer::where('user_id', $user->id)->exists())->toBeTrue()
        ->and(Wishlist::where('user_id', $user->id)->exists())->toBeTrue();

    // Queued emails dispatched
    Mail::assertQueued(VerifyEmailMailable::class, function ($mail) use ($user) {
        return $mail->user->id === $user->id;
    });

    Mail::assertQueued(WelcomeCustomerMailable::class, function ($mail) use ($user) {
        return $mail->user->id === $user->id;
    });
});

test('registration rejects weak or short passwords below 12 characters', function (): void {
    Livewire::test(Register::class)
        ->set('name', 'Weak User')
        ->set('email', 'weak@example.com')
        ->set('password', 'Short1!')
        ->set('password_confirmation', 'Short1!')
        ->set('accept_terms', true)
        ->call('register')
        ->assertHasErrors(['password']);
});

test('customer can log in with valid credentials and remember me', function (): void {
    $customer = User::where('email', 'collector@henleytea.com')->firstOrFail();

    Livewire::test(Login::class)
        ->set('email', 'collector@henleytea.com')
        ->set('password', 'Botanical#2026!Secure')
        ->set('remember', true)
        ->call('authenticate')
        ->assertRedirect('/');

    expect(Auth::check())->toBeTrue()
        ->and(Auth::id())->toBe($customer->id);
});

test('login rejects invalid credentials and displays error message', function (): void {
    Livewire::test(Login::class)
        ->set('email', 'collector@henleytea.com')
        ->set('password', 'WrongPassword123!')
        ->call('authenticate')
        ->assertHasErrors(['email']);

    expect(Auth::check())->toBeFalse();
});

test('customer can log out successfully', function (): void {
    $customer = User::where('email', 'collector@henleytea.com')->firstOrFail();
    Auth::login($customer);

    $response = $this->post(route('logout'));
    $response->assertRedirect('/');

    expect(Auth::check())->toBeFalse();
});

test('customer can request password reset link', function (): void {
    Mail::fake();

    Livewire::test(ForgotPassword::class)
        ->set('email', 'collector@henleytea.com')
        ->call('sendResetLink')
        ->assertSet('status', 'If an account matches that email address, a secure reset link has been dispatched.');

    Mail::assertQueued(ResetPasswordMailable::class);
});

test('customer can reset password using valid token', function (): void {
    $user = User::where('email', 'collector@henleytea.com')->firstOrFail();
    $token = Password::broker()->createToken($user);

    Livewire::test(ResetPassword::class, ['token' => $token])
        ->set('email', 'collector@henleytea.com')
        ->set('password', 'NewBotanical#2026!Key')
        ->set('password_confirmation', 'NewBotanical#2026!Key')
        ->call('resetPassword')
        ->assertRedirect(route('login'));

    $user->refresh();
    expect(Hash::check('NewBotanical#2026!Key', $user->password))->toBeTrue();
});

test('email verification route verifies user with valid signed URL', function (): void {
    $user = User::factory()->create([
        'email_verified_at' => null,
        'role' => UserRole::CUSTOMER,
    ]);

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    $response = $this->get($url);
    $response->assertRedirect('/');

    $user->refresh();
    expect($user->hasVerifiedEmail())->toBeTrue();
});
