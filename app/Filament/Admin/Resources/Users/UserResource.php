<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Users;

use App\Enums\UserRole;
use App\Filament\Admin\Resources\Users\Pages\CreateUser;
use App\Filament\Admin\Resources\Users\Pages\EditUser;
use App\Filament\Admin\Resources\Users\Pages\ListUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'User Account';

    protected static ?string $pluralModelLabel = 'User Accounts';

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Account Profile')
                    ->description('Administrative staff, partner estate managers, and customer accounts.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Full Name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label('Email Address')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(User::class, 'email', ignoreRecord: true),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('phone')
                                    ->label('Contact Phone')
                                    ->tel()
                                    ->maxLength(30),
                                Select::make('role')
                                    ->label('System Role')
                                    ->required()
                                    ->options([
                                        UserRole::SUPER_ADMIN->value => 'Super Administrator',
                                        UserRole::ADMIN->value => 'Administrator',
                                        UserRole::VENDOR->value => 'Estate / Vendor Partner',
                                        UserRole::CUSTOMER->value => 'Storefront Customer',
                                    ])
                                    ->live(),
                            ]),
                        Select::make('vendor_id')
                            ->label('Linked Tea Estate / Vendor Partner')
                            ->relationship('vendor', 'name')
                            ->searchable()
                            ->preload()
                            ->visible(fn (callable $get): bool => in_array($get('role'), ['vendor', UserRole::VENDOR->value], true)),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('password')
                                    ->label('Account Password')
                                    ->password()
                                    ->revealable()
                                    ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? Hash::make($state) : null)
                                    ->dehydrated(fn (?string $state): bool => filled($state))
                                    ->required(fn (string $operation): bool => $operation === 'create')
                                    ->helperText(fn (string $operation): string => $operation === 'create' ? 'Set initial password for account.' : 'Leave blank to keep existing password.'),
                                Toggle::make('is_active')
                                    ->label('Account Active Status')
                                    ->default(true)
                                    ->helperText('Inactive accounts cannot authenticate into any panel.'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->color('gray'),
                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (mixed $state): string => match ($state instanceof UserRole ? $state : UserRole::tryFrom((string) $state)) {
                        UserRole::SUPER_ADMIN => 'danger',
                        UserRole::ADMIN => 'primary',
                        UserRole::VENDOR => 'warning',
                        UserRole::CUSTOMER => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (mixed $state): string => ($state instanceof UserRole ? $state : UserRole::tryFrom((string) $state))?->label() ?? (string) $state),
                ToggleColumn::make('is_active')
                    ->label('Active'),
                TextColumn::make('last_login_at')
                    ->label('Last Login')
                    ->since()
                    ->placeholder('Never')
                    ->sortable()
                    ->color('gray'),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->date('d M Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        UserRole::SUPER_ADMIN->value => 'Super Administrator',
                        UserRole::ADMIN->value => 'Administrator',
                        UserRole::VENDOR->value => 'Estate Partner',
                        UserRole::CUSTOMER->value => 'Customer',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
