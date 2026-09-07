<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Enums\UserRole;
use App\Mail\VerifyEmailMailable;
use App\Mail\WelcomeCustomerMailable;
use App\Models\Customer;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Title('Create Collector Account')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $accept_terms = false;

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'regex:/^\+?[0-9]{10,15}$/', 'unique:users,phone'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
            'accept_terms' => ['accepted'],
        ];
    }

    public function register(): void
    {
        $this->validate();

        $ipThrottleKey = 'register|'.request()->ip();
        if (RateLimiter::tooManyAttempts($ipThrottleKey, 5)) {
            $seconds = RateLimiter::availableIn($ipThrottleKey);
            throw ValidationException::withMessages([
                'email' => "Registration temporarily paused from your network. Please wait {$seconds} seconds.",
            ]);
        }

        RateLimiter::hit($ipThrottleKey, 3600);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => ! empty($this->phone) ? $this->phone : null,
            'password' => Hash::make($this->password),
            'role' => UserRole::CUSTOMER,
            'is_active' => true,
        ]);

        $user->assignRole(['Customer', 'customer']);

        // Create Customer profile
        Customer::create([
            'user_id' => $user->id,
            'preferences' => [
                'registered_surface' => 'storefront',
            ],
        ]);

        // Create initial wishlist
        Wishlist::create([
            'user_id' => $user->id,
        ]);

        event(new Registered($user));

        activity('auth')
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip(), 'user_agent' => request()->userAgent()])
            ->log('Customer account created');

        // Generate signed verification URL & dispatch verification + welcome email
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        Mail::to($user->email)->queue(new VerifyEmailMailable($user, $verificationUrl));
        Mail::to($user->email)->queue(new WelcomeCustomerMailable($user));

        Auth::login($user);
        if (request()->hasSession()) {
            request()->session()->regenerate();
        }

        $this->redirectIntended('/');
    }

    public function render(): View
    {
        return view('livewire.auth.register');
    }
}
