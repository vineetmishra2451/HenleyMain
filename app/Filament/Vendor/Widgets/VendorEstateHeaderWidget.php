<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Widgets;

use App\Models\Vendor;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class VendorEstateHeaderWidget extends Widget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.vendor.widgets.estate-header';

    public function getVendor(): ?Vendor
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        return $user?->vendor;
    }
}
