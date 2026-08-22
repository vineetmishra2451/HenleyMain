<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Review;
use App\Models\User;

class ReviewPolicy
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
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::CUSTOMER || $user->role === UserRole::ADMIN;
    }

    public function update(User $user, Review $review): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return $review->user_id === $user->id;
    }

    public function delete(User $user, Review $review): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return $review->user_id === $user->id;
    }
}
