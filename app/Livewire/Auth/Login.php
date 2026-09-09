<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Title('Collector Sign In')]
class Login extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function mount(): void
    {
        if (Auth::check()) {
            $this->redirectIntended('/');
        }
    }

    public function authenticate(): void
    {
        $this->validate();

        $throttleKey = Str::transliterate(Str::lower($this->email)).'|'.request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            activity('auth')
                ->withProperties(['email' => $this->email, 'ip' => request()->ip(), 'user_agent' => request()->userAgent()])
                ->log('Login throttled - maximum attempts exceeded');

            throw ValidationException::withMessages([
                'email' => "Too many authentication attempts. Please pause for {$seconds} seconds.",
            ]);
        }

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (! Auth::attempt($credentials, $this->remember)) {
            RateLimiter::hit($throttleKey, 900); // 15 minute backoff

            activity('auth')
                ->withProperties(['attempted_email' => $this->email, 'ip' => request()->ip(), 'user_agent' => request()->userAgent()])
                ->log('Failed login attempt');

            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        RateLimiter::clear($throttleKey);
        if (request()->hasSession()) {
            request()->session()->regenerate();
        }

        /** @var User $user */
        $user = Auth::user();

        // Rehash password if algorithm parameters updated
        if (Hash::needsRehash($user->password)) {
            $user->password = Hash::make($this->password);
            $user->save();
        }

        activity('auth')
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip(), 'user_agent' => request()->userAgent()])
            ->log('Successful user login');

        // Redirect based on role and intended URL
        if ($user->role === UserRole::VENDOR) {
            $this->redirect('http://' . config('domains.vendor', 'vendor.henley.com'));

            return;
        }

        if ($user->role === UserRole::SUPER_ADMIN || $user->role === UserRole::ADMIN) {
            $this->redirect('http://' . config('domains.admin', 'admin.henley.com'));

            return;
        }

        $this->redirectIntended('/');
    }

    public function render(): View
    {
        return view('livewire.auth.login', [
            'otpEnabled' => config('henley.auth.otp_enabled', false),
        ]);
    }
}
