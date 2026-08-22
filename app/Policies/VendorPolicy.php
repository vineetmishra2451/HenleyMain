<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Vendor;

class VendorPolicy
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
        return $user->role === UserRole::ADMIN;
    }

    public function view(User $user, Vendor $vendor): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return $user->role === UserRole::VENDOR && $user->vendor_id === $vendor->id;
    }

    public function update(User $user, Vendor $vendor): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return $user->role === UserRole::VENDOR && $user->vendor_id === $vendor->id;
    }

    public function delete(User $user, Vendor $vendor): bool
    {
        return $user->role === UserRole::ADMIN;
    }
}
