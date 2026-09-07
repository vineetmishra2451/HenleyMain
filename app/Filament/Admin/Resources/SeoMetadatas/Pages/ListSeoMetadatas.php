<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\SeoMetadatas\Pages;

use App\Filament\Admin\Resources\SeoMetadatas\SeoMetadataResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSeoMetadatas extends ListRecords
{
    protected static string $resource = SeoMetadataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
