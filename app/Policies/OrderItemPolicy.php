<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\OrderItem;
use App\Models\User;

class OrderItemPolicy
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

    public function view(User $user, OrderItem $orderItem): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        if ($user->role === UserRole::VENDOR) {
            return $orderItem->vendor_id === $user->vendor_id;
        }

        return $orderItem->order?->user_id === $user->id;
    }
}
