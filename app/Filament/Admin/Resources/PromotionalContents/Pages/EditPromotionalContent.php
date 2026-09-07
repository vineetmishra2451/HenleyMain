<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\PromotionalContents\Pages;

use App\Filament\Admin\Resources\PromotionalContents\PromotionalContentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPromotionalContent extends EditRecord
{
    protected static string $resource = PromotionalContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
