<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Roles;

use App\Filament\Admin\Resources\Roles\Pages\CreateRole;
use App\Filament\Admin\Resources\Roles\Pages\EditRole;
use App\Filament\Admin\Resources\Roles\Pages\ListRoles;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;
use UnitEnum;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $modelLabel = 'Staff Role & Policy';

    protected static ?string $pluralModelLabel = 'Staff Roles & Policies';

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Role Definition')
                    ->description('Specify role title and authentication guard for authorization checks.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Role Name')
                                    ->required()
                                    ->maxLength(100)
                                    ->unique(Role::class, 'name', ignoreRecord: true)
                                    ->placeholder('e.g. Master Apothecary, Catalog Editor, Operations Lead'),
                                TextInput::make('guard_name')
                                    ->label('Guard Name')
                                    ->default('web')
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                    ]),

                Section::make('Access Control Permissions')
                    ->description('Map granular resource abilities across catalogue, commerce, and security boundaries.')
                    ->schema([
                        ViewField::make('permissions')
                            ->label('2D Permission Matrix')
                            ->view('filament.admin.forms.components.permission-matrix')
                            ->dehydrated()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Role Title')
                    ->weight('bold')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Super Admin', 'super_admin' => 'danger',
                        'Admin', 'admin' => 'primary',
                        'Vendor', 'vendor' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('guard_name')
                    ->label('Guard')
                    ->fontFamily('mono')
                    ->color('gray'),
                TextColumn::make('permissions_count')
                    ->label('Permissions Granted')
                    ->counts('permissions')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('users_count')
                    ->label('Assigned Users')
                    ->counts('users')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->date('d M Y')
                    ->sortable()
                    ->color('gray'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->visible(fn (Role $record): bool => ! in_array($record->name, ['Super Admin', 'super_admin', 'Admin', 'admin'], true)),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }
}
