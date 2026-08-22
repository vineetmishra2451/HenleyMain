<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class VendorScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * Automatically confines queries to the authenticated vendor's vendor_id.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        if ($user instanceof User && $user->role === UserRole::VENDOR && $user->vendor_id !== null) {
            $builder->where($model->qualifyColumn('vendor_id'), $user->vendor_id);
        }
    }
}
