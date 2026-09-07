<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Executive Dashboard';

    public function getSubheading(): string | Htmlable | null
    {
        return 'Overview of sales performance, orders, inventory alerts, and vendor activity across the Henley platform.';
    }

    /**
     * Responsive widget grid:
     * - Mobile (< md): 1 column (vertical stack)
     * - Desktop (>= md): 2 columns
     *
     * @return int | array<string, ?int>
     */
    public function getColumns(): int | array
    {
        return [
            'default' => 1,
            'sm' => 1,
            'md' => 2,
            'lg' => 2,
            'xl' => 2,
        ];
    }
}
