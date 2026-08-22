<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Vendor;
use App\Policies\CouponPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\OrderItemPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\ShipmentPolicy;
use App\Policies\VendorPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    protected array $policies = [
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        OrderItem::class => OrderItemPolicy::class,
        Shipment::class => ShipmentPolicy::class,
        Vendor::class => VendorPolicy::class,
        Coupon::class => CouponPolicy::class,
        Customer::class => CustomerPolicy::class,
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind SMS Service Contract
        $this->app->singleton(\App\Contracts\SmsServiceContract::class, function () {
            return new \App\Services\LogSmsService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(! $this->app->isProduction());

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // 1. Super Admin Universal Bypass via Gate::before
        Gate::before(function (User $user, string $ability): ?bool {
            if ($user->role === UserRole::SUPER_ADMIN || $user->hasRole('super_admin')) {
                return true;
            }

            return null;
        });

        // 2. Explicit Policy Registrations
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }

        // 3. Password Security Rule Defaults (Min 12 chars, letters, numbers, symbols, uncompromised check)
        Password::defaults(function () {
            $rule = Password::min(12)
                ->letters()
                ->numbers()
                ->symbols();

            return $this->app->isProduction() ? $rule->uncompromised() : $rule;
        });

        // 4. Rate Limiting Configurations
        $this->configureRateLimiting();
    }

    /**
     * Configure granular rate limiters for authentication surfaces.
     */
    protected function configureRateLimiting(): void
    {
        // Login limiter with email + IP throttling and progressive lockout
        RateLimiter::for('login', function (Request $request) {
            $email = Str::transliterate(Str::lower((string) $request->input('email')));

            return [
                Limit::perMinutes(15, 5)->by($email.$request->ip())->response(function () {
                    return response()->json([
                        'message' => 'Too many login attempts. For security, your access is paused for 15 minutes.',
                    ], 429);
                }),
                Limit::perMinute(5)->by($request->ip()),
            ];
        });

        // Storefront registration rate limit
        RateLimiter::for('register', function (Request $request) {
            return Limit::perHour(5)->by($request->ip());
        });

        // Password reset rate limit
        RateLimiter::for('password-reset', function (Request $request) {
            $email = Str::transliterate(Str::lower((string) $request->input('email')));

            return Limit::perHour(3)->by($email.$request->ip());
        });

        // OTP request rate limit (per phone and per IP)
        RateLimiter::for('otp-request', function (Request $request) {
            $phone = (string) $request->input('phone');

            return [
                Limit::perMinutes(15, 3)->by($phone),
                Limit::perMinutes(15, 5)->by($request->ip()),
            ];
        });
    }
}
