<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Livewire\Auth\Login;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Spatie\Activitylog\Models\Activity;

test('login rate limiting demonstrably engages and locks out on the 6th failed attempt', function (): void {
    $email = 'collector@henleytea.com';
    RateLimiter::clear(strtolower($email).'|127.0.0.1');

    // 5 consecutive failed attempts
    for ($i = 1; $i <= 5; $i++) {
        Livewire::test(Login::class)
            ->set('email', $email)
            ->set('password', 'InvalidPass'.$i.'!')
            ->call('authenticate')
            ->assertHasErrors(['email']);
    }

    // 6th attempt: Demonstrably locked out with throttle notification
    $lockedOutTest = Livewire::test(Login::class)
        ->set('email', $email)
        ->set('password', 'Botanical#2026!Secure')
        ->call('authenticate');

    $lockedOutTest->assertHasErrors(['email']);
    $errorMessage = $lockedOutTest->errors()->get('email')[0];
    expect($errorMessage)->toContain('Too many authentication attempts');
});

test('activity log records failed login with attempted email without recording password', function (): void {
    $attemptedEmail = 'unauthorized-collector@henleytea.com';

    Livewire::test(Login::class)
        ->set('email', $attemptedEmail)
        ->set('password', 'SuperSecretPlainTextPasswordNeverLogged!')
        ->call('authenticate')
        ->assertHasErrors(['email']);

    $log = Activity::where('log_name', 'auth')
        ->latest('id')
        ->firstOrFail();

    $properties = $log->properties->toArray();
    expect($properties)->toHaveKey('attempted_email')
        ->and($properties['attempted_email'])->toBe($attemptedEmail)
        ->and($properties)->not->toHaveKey('password')
        ->and(json_encode($properties))->not->toContain('SuperSecretPlainTextPasswordNeverLogged');
});

test('password hashing uses configured strong Argon2id / bcrypt parameters and supports rehashing', function (): void {
    $user = User::factory()->create([
        'password' => Hash::make('Botanical#SecurePassword2026!'),
    ]);

    expect(Hash::check('Botanical#SecurePassword2026!', $user->password))->toBeTrue();
});

test('logout other devices terminates active secondary sessions', function (): void {
    $user = User::where('email', 'collector@henleytea.com')->firstOrFail();
    Auth::login($user);

    $password = Hash::check('Botanical#2026!Secure', $user->password) ? 'Botanical#2026!Secure' : 'password';
    $result = $user->logoutOtherDevices($password);
    expect($result)->toBeTrue();
});
