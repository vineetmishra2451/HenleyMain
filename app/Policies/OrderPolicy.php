<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role === UserRole::SUPER_ADMIN || $user->hasRole('super_admin')) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::ADMIN || $user->role === UserRole::VENDOR;
    }

    public function view(User $user, Order $order): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        if ($user->role === UserRole::VENDOR) {
            return $order->items()->where('vendor_id', $user->vendor_id)->exists();
        }

        return $order->user_id === $user->id;
    }

    public function update(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    public function delete(User $user, Order $order): bool
    {
        return false; // Financial records are immutable / never hard deleted
    }
}
