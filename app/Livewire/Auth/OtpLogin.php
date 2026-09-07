<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Contracts\SmsServiceContract;
use App\Enums\UserRole;
use App\Models\Customer;
use App\Models\OtpCode;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Title('OTP Authentication')]
class OtpLogin extends Component
{
    public string $phone = '';

    public string $code = '';

    public bool $codeSent = false;

    public ?string $status = null;

    public function mount(): void
    {
        if (Auth::check()) {
            $this->redirectIntended('/');
        }
    }

    public function sendOtp(SmsServiceContract $smsService): void
    {
        $this->validate([
            'phone' => ['required', 'string', 'regex:/^\+?[0-9]{10,15}$/'],
        ]);

        $phoneKey = 'otp-send-phone|'.$this->phone;
        $ipKey = 'otp-send-ip|'.request()->ip();

        if (RateLimiter::tooManyAttempts($phoneKey, 3) || RateLimiter::tooManyAttempts($ipKey, 5)) {
            $seconds = max(RateLimiter::availableIn($phoneKey), RateLimiter::availableIn($ipKey));
            throw ValidationException::withMessages([
                'phone' => "Too many OTP requests. Please wait {$seconds} seconds.",
            ]);
        }

        RateLimiter::hit($phoneKey, 900); // 15 min throttle
        RateLimiter::hit($ipKey, 900);

        // Invalidate existing pending OTPs for this phone
        OtpCode::where('identifier', $this->phone)
            ->whereNull('verified_at')
            ->delete();

        $rawCode = (string) random_int(100000, 999999);

        // Store hashed single-use OTP
        OtpCode::create([
            'identifier' => $this->phone,
            'code' => Hash::make($rawCode),
            'type' => 'login',
            'expires_at' => now()->addMinutes(config('henley.auth.otp_expiry_minutes', 5)),
            'attempts' => 0,
        ]);

        $smsService->sendOtp($this->phone, $rawCode);

        activity('auth')
            ->withProperties(['phone' => $this->phone, 'ip' => request()->ip()])
            ->log('Single-use OTP dispatched');

        $this->codeSent = true;
        $this->status = "A 6-digit authentication code has been sent to {$this->phone}.";
    }

    public function verifyOtp(): void
    {
        $this->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $otpRecord = OtpCode::where('identifier', $this->phone)
            ->whereNull('verified_at')
            ->latest('id')
            ->first();

        if (! $otpRecord) {
            throw ValidationException::withMessages([
                'code' => 'No active OTP found for this phone number. Please request a new code.',
            ]);
        }

        if ($otpRecord->expires_at->isPast()) {
            $otpRecord->delete();
            throw ValidationException::withMessages([
                'code' => 'This verification code has expired. Please request a new code.',
            ]);
        }

        if ($otpRecord->attempts >= config('henley.auth.otp_max_attempts', 3)) {
            $otpRecord->delete();
            throw ValidationException::withMessages([
                'code' => 'Maximum verification attempts exceeded. Please request a new code.',
            ]);
        }

        $otpRecord->increment('attempts');

        if (! Hash::check($this->code, $otpRecord->code)) {
            $remaining = config('henley.auth.otp_max_attempts', 3) - $otpRecord->attempts;
            throw ValidationException::withMessages([
                'code' => "Invalid code. {$remaining} attempts remaining.",
            ]);
        }

        // Mark OTP as single-use consumed
        $otpRecord->update(['verified_at' => now()]);

        // Find or create customer
        $user = User::where('phone', $this->phone)->first();

        if (! $user) {
            $email = 'collector-'.Str::random(8).'@henleytea.com';
            $user = User::create([
                'name' => 'Henley Collector',
                'email' => $email,
                'phone' => $this->phone,
                'password' => Hash::make(Str::random(32)),
                'role' => UserRole::CUSTOMER,
                'is_active' => true,
            ]);

            $user->assignRole(['Customer', 'customer']);

            Customer::create([
                'user_id' => $user->id,
                'preferences' => ['auth_method' => 'otp'],
            ]);

            Wishlist::create([
                'user_id' => $user->id,
            ]);
        }

        Auth::login($user);
        if (request()->hasSession()) {
            request()->session()->regenerate();
        }

        activity('auth')
            ->causedBy($user)
            ->withProperties(['method' => 'otp', 'ip' => request()->ip()])
            ->log('Successful OTP login');

        $this->redirectIntended('/');
    }

    public function resendCode(SmsServiceContract $smsService): void
    {
        $this->code = '';
        $this->sendOtp($smsService);
    }

    public function render(): View
    {
        return view('livewire.auth.otp-login');
    }
}
