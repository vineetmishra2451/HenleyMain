<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Mail\VerifyEmailMailable;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Title('Verify Email Address')]
class VerifyEmail extends Component
{
    public ?string $status = null;

    public function resendVerification(): void
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            $this->redirect(route('login'));

            return;
        }

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended('/');

            return;
        }

        $throttleKey = 'email-verify-resend|'.$user->id;
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => "Please wait {$seconds} seconds before requesting another verification email.",
            ]);
        }

        RateLimiter::hit($throttleKey, 300);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        Mail::to($user->email)->queue(new VerifyEmailMailable($user, $verificationUrl));

        $this->status = 'A new verification link has been sent to your registered email address.';
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        $this->redirect(route('login'));
    }

    public function render(): View
    {
        return view('livewire.auth.verify-email');
    }
}
