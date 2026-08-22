<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Shipment;
use App\Models\User;

class ShipmentPolicy
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

    public function view(User $user, Shipment $shipment): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        if ($user->role === UserRole::VENDOR) {
            return $shipment->vendor_id === $user->vendor_id;
        }

        return $shipment->order?->user_id === $user->id;
    }

    public function update(User $user, Shipment $shipment): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        if ($user->role === UserRole::VENDOR) {
            return $shipment->vendor_id === $user->vendor_id;
        }

        return false;
    }
}
