<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\CmsPages\Pages;

use App\Filament\Admin\Resources\CmsPages\CmsPageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCmsPage extends CreateRecord
{
    protected static string $resource = CmsPageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
