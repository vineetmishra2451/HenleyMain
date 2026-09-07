<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\PromotionalContents\Pages;

use App\Filament\Admin\Resources\PromotionalContents\PromotionalContentResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePromotionalContent extends CreateRecord
{
    protected static string $resource = PromotionalContentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
