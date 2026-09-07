<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\SeoMetadatas\Pages;

use App\Filament\Admin\Resources\SeoMetadatas\SeoMetadataResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSeoMetadata extends CreateRecord
{
    protected static string $resource = SeoMetadataResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
