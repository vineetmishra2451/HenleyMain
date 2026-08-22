<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
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

    public function view(User $user, Customer $customer): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return $customer->user_id === $user->id;
    }

    public function update(User $user, Customer $customer): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return $customer->user_id === $user->id;
    }
}
