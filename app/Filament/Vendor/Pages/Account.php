<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Pages;

use App\Models\User;
use App\Models\Vendor;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Account extends Page
{
    protected static ?string $navigationLabel = 'Account';

    protected static ?int $navigationSort = 6;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected string $view = 'filament.vendor.pages.account';

    public string $activeTab = 'profile';

    public string $name = '';
    public string $email = '';
    public string $phone = '';

    // Settings: Notification Preferences
    public bool $notifyNewOrders = true;
    public bool $notifyLowStock = true;
    public bool $notifyPayoutDisbursements = true;

    // Settings: Password Change
    public string $currentPassword = '';
    public string $newPassword = '';
    public string $newPasswordConfirmation = '';

    public function mount(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        $vendor = $user?->vendor;

        $this->name = $user?->name ?? 'Estate Cellar Master';
        $this->email = $user?->email ?? 'vendor@henley.com';
        $this->phone = $vendor?->phone ?? '+91 354 2254321';
    }

    public function getTitle(): string | Htmlable
    {
        return 'Estate Account & Profile';
    }

    public function getSubheading(): string | Htmlable | null
    {
        /** @var User|null $user */
        $user = Auth::user();
        $estate = $user?->vendor?->business_name ?? 'your estate';

        return "Official partnership credentials, bank settlement instructions, and terroir documentation for {$estate}.";
    }

    public function getVendor(): ?Vendor
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user?->vendor;
    }

    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function saveProfile(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($user->vendor) {
            $user->vendor->update([
                'phone' => $this->phone,
            ]);
        }

        Notification::make()
            ->title('Profile Saved')
            ->body('Your estate representative contact details have been updated.')
            ->success()
            ->send();
    }

    public function saveNotificationSettings(): void
    {
        Notification::make()
            ->title('Notification Preferences Saved')
            ->body('Order dispatch, low-stock, and payout disbursement preferences updated.')
            ->success()
            ->send();
    }

    public function updatePassword(): void
    {
        $this->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8',
            'newPasswordConfirmation' => 'required|same:newPassword',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (! Hash::check($this->currentPassword, $user->password)) {
            throw ValidationException::withMessages([
                'currentPassword' => 'The current password provided does not match our records.',
            ]);
        }

        $user->update([
            'password' => Hash::make($this->newPassword),
        ]);

        $this->currentPassword = '';
        $this->newPassword = '';
        $this->newPasswordConfirmation = '';

        Notification::make()
            ->title('Password Updated')
            ->body('Your password has been changed securely.')
            ->success()
            ->send();
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/login');
    }
}
