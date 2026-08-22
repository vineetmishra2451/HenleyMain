<?php

declare(strict_types=1);

namespace App\Livewire\Storefront;

use App\Mail\WelcomeCustomerMailable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewsletterSignup extends Component
{
    #[Validate('required|email:filter|max:255')]
    public string $email = '';

    public bool $subscribed = false;

    public function subscribe(): void
    {
        $this->validate();

        $ip = request()->ip() ?? '127.0.0.1';
        $throttleKey = 'newsletter:'.$ip;

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => "Too many subscription attempts. Please wait {$seconds} seconds.",
            ]);
        }

        RateLimiter::hit($throttleKey, 300);

        // Check if customer user exists or send welcome dispatch
        $existingUser = User::where('email', $this->email)->first();
        if ($existingUser) {
            Mail::to($this->email)->queue(new WelcomeCustomerMailable($existingUser));
        }

        $this->subscribed = true;
        $this->email = '';

        $this->dispatch('notify', [
            'tone' => 'success',
            'message' => 'Welcome to the Henley Collector Circle. Your invitation has been dispatched.',
        ]);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.storefront.newsletter-signup');
    }
}
