<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;

class ProductPolicy
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

    public function view(User $user, Product $product): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        if ($user->role === UserRole::VENDOR) {
            return $product->vendor_id === $user->vendor_id;
        }

        return $product->status->value === 'published';
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::ADMIN || $user->role === UserRole::VENDOR;
    }

    public function update(User $user, Product $product): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        if ($user->role === UserRole::VENDOR) {
            return $product->vendor_id === $user->vendor_id;
        }

        return false;
    }

    public function delete(User $user, Product $product): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        if ($user->role === UserRole::VENDOR) {
            return $product->vendor_id === $user->vendor_id;
        }

        return false;
    }
}
