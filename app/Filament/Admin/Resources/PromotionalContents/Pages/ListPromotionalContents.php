<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\PromotionalContents\Pages;

use App\Filament\Admin\Resources\PromotionalContents\PromotionalContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPromotionalContents extends ListRecords
{
    protected static string $resource = PromotionalContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
