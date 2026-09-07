<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;

class ReportsOverviewWidget extends Widget
{
    protected string $view = 'filament.admin.widgets.reports-overview';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 6;

    protected static bool $isLazy = false;
}
