<?php

declare(strict_types=1);

namespace App\Models;

use App\Contracts\TwoFactorAuthenticatable;
use App\Enums\UserRole;
use App\Models\Concerns\HasTwoFactorAuthentication;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * User Model for Henley.
 *
 * Serves Super Admins, Admins, Vendor Partners, and Customers.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property UserRole $role
 * @property int|null $vendor_id
 * @property bool $is_active
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property \Illuminate\Support\Carbon|null $two_factor_confirmed_at
 */
class User extends Authenticatable implements FilamentUser, MustVerifyEmail, TwoFactorAuthenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, HasTwoFactorAuthentication, LogsActivity, Notifiable;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'vendor_id',
        'is_active',
        'referral_code',
        'wallet_balance',
        'last_login_at',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'is_active' => 'boolean',
            'wallet_balance' => 'decimal:2',
        ];
    }

    /**
     * Associated Vendor Organization (for vendor partners).
     *
     * @return BelongsTo<Vendor, $this>
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Associated Customer Profile (for storefront shoppers).
     *
     * @return HasOne<Customer, $this>
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Customer Orders.
     *
     * @return HasMany<Order, $this>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Customer Wishlist.
     *
     * @return HasOne<Wishlist, $this>
     */
    public function wishlist(): HasOne
    {
        return $this->hasOne(Wishlist::class);
    }

    /**
     * Customer Reviews.
     *
     * @return HasMany<Review, $this>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Customer Active Cart.
     *
     * @return HasOne<Cart, $this>
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Customer Saved Addresses.
     *
     * @return HasMany<Address, $this>
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return HasMany<CustomerReferral, $this>
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(CustomerReferral::class, 'referrer_id');
    }

    /**
     * @return HasMany<WalletTransaction, $this>
     */
    public function walletTransactions(): HasMany
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function getOrCreateReferralCode(): string
    {
        if (! $this->referral_code) {
            $cleanName = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $this->name) ?: 'PATRON');
            $slug = substr($cleanName, 0, 6);
            $code = 'HENLEY-' . $slug . '-' . strtoupper(substr(md5((string) $this->id), 0, 4));
            $this->update(['referral_code' => $code]);
        }

        return $this->referral_code;
    }

    public function creditWallet(float $amount, string $description, ?string $referenceId = null): WalletTransaction
    {
        $newBalance = (float) $this->wallet_balance + $amount;
        $this->update(['wallet_balance' => $newBalance]);

        return $this->walletTransactions()->create([
            'type' => 'credit',
            'amount' => $amount,
            'balance_after' => $newBalance,
            'description' => $description,
            'reference_id' => $referenceId,
        ]);
    }

    /**
     * Determine if user can access a Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if (! ($this->is_active ?? true)) {
            return false;
        }

        if ($panel->getId() === 'admin') {
            return ($this->hasRole(['super_admin', 'admin', 'Super Admin', 'Admin'])
                || $this->role === UserRole::SUPER_ADMIN || $this->role === UserRole::ADMIN)
                && ! ($this->hasRole(['vendor', 'Vendor']) && ! $this->hasRole(['super_admin', 'admin', 'Super Admin', 'Admin']));
        }

        if ($panel->getId() === 'vendor') {
            return ($this->hasRole(['vendor', 'Vendor']) || $this->role === UserRole::VENDOR)
                && ! empty($this->vendor_id)
                && ! $this->hasRole(['super_admin', 'admin', 'Super Admin', 'Admin']);
        }

        return false;
    }

    public function logoutOtherDevices(string $currentPassword): bool
    {
        Auth::logoutOtherDevices($currentPassword);

        return true;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'phone', 'role', 'vendor_id', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
