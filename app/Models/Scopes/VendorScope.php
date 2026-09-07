<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Enums\UserRole;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

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

        if (! ($user instanceof User)) {
            return;
        }

        $isVendor = $user->role === UserRole::VENDOR || $user->hasRole(['Vendor', 'vendor']);

        if ($isVendor && ! empty($user->vendor_id)) {
            if ($model instanceof Vendor) {
                $builder->where($model->qualifyColumn('id'), $user->vendor_id);
            } elseif ($model instanceof Order) {
                $builder->whereHas('items', function (Builder $itemQuery) use ($user): void {
                    $itemQuery->where('vendor_id', $user->vendor_id);
                });
            } elseif ($model instanceof Inventory || $model instanceof StockMovement) {
                $builder->whereHas('variant.product', function (Builder $productQuery) use ($user): void {
                    $productQuery->where('vendor_id', $user->vendor_id);
                });
            } elseif (Schema::hasColumn($model->getTable(), 'vendor_id')) {
                $builder->where($model->qualifyColumn('vendor_id'), $user->vendor_id);
            }
        }
    }
}
