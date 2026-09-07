<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    /**
     * Authenticate user with customized rate limiting, progressive lockout,
     * session regeneration, and activity logging.
     */
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            activity('auth')
                ->withProperties([
                    'panel' => Filament::getId(),
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log('Filament login throttled - too many requests');

            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]),
            ]);
        }

        $data = $this->form->getState();
        $email = Str::transliterate(Str::lower((string) $data['email']));
        $throttleKey = 'filament-login|'.$email.'|'.request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            activity('auth')
                ->withProperties([
                    'panel' => Filament::getId(),
                    'attempted_email' => $data['email'],
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log('Filament login lockout engaged');

            throw ValidationException::withMessages([
                'data.email' => "Too many failed attempts. Please wait {$seconds} seconds.",
            ]);
        }

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (! Filament::auth()->attempt($credentials, (bool) ($data['remember'] ?? false))) {
            RateLimiter::hit($throttleKey, 900); // 15-minute backoff

            activity('auth')
                ->withProperties([
                    'panel' => Filament::getId(),
                    'attempted_email' => $data['email'],
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log('Filament failed login attempt');

            $this->throwFailureValidationException();
        }

        RateLimiter::clear($throttleKey);

        $user = Filament::auth()->user();

        if ($user instanceof User) {
            // Enforce panel access check
            if (! $user->canAccessPanel(Filament::getCurrentOrDefaultPanel())) {
                Filament::auth()->logout();

                activity('auth')
                    ->causedBy($user)
                    ->withProperties([
                        'panel' => Filament::getId(),
                        'role' => $user->role->value,
                        'ip' => request()->ip(),
                    ])
                    ->log('Cross-role panel access denied');

                abort(403, 'Access denied. You do not hold permissions for this management portal.');
            }

            // Rehash password if algorithm parameters changed
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($data['password']);
                $user->save();
            }

            $user->last_login_at = now();
            $user->saveQuietly();

            activity('auth')
                ->causedBy($user)
                ->withProperties([
                    'panel' => Filament::getId(),
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log('Filament login successful');
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }
}
