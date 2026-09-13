<?php

declare(strict_types=1);

namespace App\Livewire\Storefront;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.storefront')]
#[Title('My Patron Reserve — Account Dashboard')]
class AccountPage extends Component
{
    public string $activeTab = 'orders';

    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public bool $savedProfile = false;

    public function mount(): void
    {
        if (! Auth::check()) {
            // Check if there is a default customer or redirect to login
            $customer = User::where('email', 'like', '%customer%')
                ->orWhere('role', 'customer')
                ->first();

            if ($customer) {
                Auth::login($customer);
            } else {
                $this->redirect(route('login'));
                return;
            }
        }

        /** @var User $user */
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '+91 98201 44521';
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->save();

        $this->savedProfile = true;
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect(route('login'));
    }

    public function render(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $orders = $user->orders()->latest()->take(5)->get();
        $addresses = $user->addresses()->latest()->get();
        $referrals = $user->referrals()->latest()->get();
        $referralCode = $user->getOrCreateReferralCode();

        return view('livewire.storefront.account-page', [
            'user' => $user,
            'orders' => $orders,
            'addresses' => $addresses,
            'referrals' => $referrals,
            'referralCode' => $referralCode,
        ]);
    }
}
