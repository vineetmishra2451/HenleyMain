<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Resources\Products\Pages;

use App\Filament\Vendor\Resources\Products\ProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected static ?string $title = 'Products & Harvest Reserves';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add Product')
                ->icon('heroicon-o-plus-circle'),
        ];
    }
}
