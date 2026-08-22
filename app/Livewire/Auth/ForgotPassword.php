<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Mail\ResetPasswordMailable;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Title('Reset Password')]
class ForgotPassword extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    public ?string $status = null;

    public function sendResetLink(): void
    {
        $this->validate();

        $throttleKey = 'password-reset|'.Str::transliterate(Str::lower($this->email)).'|'.request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => "Too many reset requests. Please pause for {$seconds} seconds.",
            ]);
        }

        RateLimiter::hit($throttleKey, 3600);

        $user = User::where('email', $this->email)->first();

        if ($user) {
            $token = Password::broker()->createToken($user);
            $resetUrl = route('password.reset', [
                'token' => $token,
                'email' => $user->email,
            ]);

            Mail::to($user->email)->queue(new ResetPasswordMailable($user, $resetUrl));

            activity('auth')
                ->causedBy($user)
                ->withProperties(['ip' => request()->ip()])
                ->log('Password reset link requested');
        }

        $this->status = 'If an account matches that email address, a secure reset link has been dispatched.';
    }

    public function render(): View
    {
        return view('livewire.auth.forgot-password');
    }
}
