<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Roles\Pages;

use App\Filament\Admin\Resources\Roles\RoleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Spatie\Permission\Models\Role;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record instanceof Role) {
            $data['permissions'] = $this->record->permissions->pluck('name')->toArray();
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $permissions = $this->data['permissions'] ?? [];
        if ($this->record instanceof Role) {
            $this->record->syncPermissions($permissions);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->visible(fn (): bool => ! in_array($this->record->name, ['Super Admin', 'super_admin', 'Admin', 'admin'], true)),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
