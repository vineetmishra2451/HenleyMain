<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Vendors;

use App\Enums\VendorStatus;
use App\Filament\Admin\Resources\Vendors\Pages\CreateVendor;
use App\Filament\Admin\Resources\Vendors\Pages\EditVendor;
use App\Filament\Admin\Resources\Vendors\Pages\ListVendors;
use App\Filament\Admin\Resources\Vendors\RelationManagers\InventoriesRelationManager;
use App\Filament\Admin\Resources\Vendors\RelationManagers\OrdersRelationManager;
use App\Filament\Admin\Resources\Vendors\RelationManagers\ProductsRelationManager;
use App\Filament\Admin\Resources\Vendors\RelationManagers\VendorPerformanceRelationManager;
use App\Models\Vendor;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use UnitEnum;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static string|UnitEnum|null $navigationGroup = 'Commerce';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static ?string $recordTitleAttribute = 'business_name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Estate & Business Details')
                    ->description('Primary commercial credentials and revenue agreements.')
                    ->schema([
                        TextInput::make('business_name')
                            ->label('Partner Estate / Brand Name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, callable $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state ?? ''));
                                }
                            }),
                        TextInput::make('legal_name')
                            ->label('Registered Entity Name')
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Vendor::class, 'slug', ignoreRecord: true),
                        TextInput::make('gstin')
                            ->label('GSTIN / Tax ID')
                            ->maxLength(20)
                            ->placeholder('e.g. 19AAAAA0000A1Z5'),
                        TextInput::make('commission_rate')
                            ->label('Platform Commission (%)')
                            ->numeric()
                            ->default(15.00)
                            ->suffix('%')
                            ->required(),
                    ])->columns(2),

                Section::make('Contact & Botanical Estate Location')
                    ->description('Official communication and provenance address.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Contact Email')
                                    ->email()
                                    ->required()
                                    ->unique(Vendor::class, 'email', ignoreRecord: true),
                                TextInput::make('phone')
                                    ->label('Phone Number')
                                    ->tel(),
                            ]),
                        TextInput::make('address.line_1')
                            ->label('Street Address / Estate Route')
                            ->placeholder('e.g. Happy Valley Tea Estate, Lebong Cart Rd'),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('address.city')
                                    ->label('City / District')
                                    ->placeholder('Darjeeling'),
                                TextInput::make('address.state')
                                    ->label('State / Region')
                                    ->placeholder('West Bengal'),
                                TextInput::make('address.pincode')
                                    ->label('Pincode / Postal Code')
                                    ->placeholder('734101'),
                            ]),
                    ]),

                Section::make('Status & Estate Partnership')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active Partner Estate')
                            ->helperText('Enable or suspend this partner estate across the marketplace')
                            ->formatStateUsing(fn (?Vendor $record): bool => $record ? $record->status === VendorStatus::APPROVED : true)
                            ->mutateDehydratedStateUsing(fn (bool $state): VendorStatus => $state ? VendorStatus::APPROVED : VendorStatus::SUSPENDED)
                            ->statePath('status'),
                        Textarea::make('notes')
                            ->label('Partnership & Terroir Notes')
                            ->placeholder('Details about estate altitude, flushes, harvest cadence, or compliance notes...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('business_name')
                    ->label('Estate / Business')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (Vendor $record): ?string => $record->legal_name),
                TextColumn::make('email')
                    ->label('Contact Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),
                TextColumn::make('products_count')
                    ->counts('products')
                    ->label('Products')
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->alignEnd(),
                TextColumn::make('orders_count')
                    ->counts('orders')
                    ->label('Orders')
                    ->sortable()
                    ->badge()
                    ->color('primary')
                    ->alignEnd(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (VendorStatus $state): string => match ($state) {
                        VendorStatus::APPROVED => 'Active',
                        VendorStatus::SUSPENDED => 'Suspended',
                        VendorStatus::PENDING => 'Pending',
                        VendorStatus::REJECTED => 'Rejected',
                    })
                    ->color(fn (VendorStatus $state): string => match ($state) {
                        VendorStatus::APPROVED => 'success',
                        VendorStatus::SUSPENDED => 'danger',
                        VendorStatus::PENDING => 'warning',
                        VendorStatus::REJECTED => 'gray',
                    })
                    ->alignCenter(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        VendorStatus::APPROVED->value => 'Active',
                        VendorStatus::SUSPENDED->value => 'Suspended',
                        VendorStatus::PENDING->value => 'Pending Review',
                        VendorStatus::REJECTED->value => 'Rejected',
                    ]),
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
        return [
            ProductsRelationManager::class,
            InventoriesRelationManager::class,
            OrdersRelationManager::class,
            VendorPerformanceRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVendors::route('/'),
            'create' => CreateVendor::route('/create'),
            'edit' => EditVendor::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
