<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Customers;

use App\Enums\OrderStatus;
use App\Filament\Admin\Resources\Customers\Pages\ListCustomers;
use App\Filament\Admin\Resources\Customers\Pages\ViewCustomer;
use App\Filament\Admin\Resources\Customers\RelationManagers\CustomerActivityRelationManager;
use App\Filament\Admin\Resources\Customers\RelationManagers\CustomerAddressesRelationManager;
use App\Filament\Admin\Resources\Customers\RelationManagers\CustomerOrdersRelationManager;
use App\Models\Customer;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static string|UnitEnum|null $navigationGroup = 'Commerce';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    public static function getRecordTitle(?\Illuminate\Database\Eloquent\Model $record): string|\Illuminate\Contracts\Support\Htmlable|null
    {
        /** @var Customer|null $record */
        return $record?->user?->name ?? 'Customer Profile';
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Client Overview')
                    ->description('Essential account credentials and lifetime value.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Customer Name')
                                    ->weight('bold'),
                                TextEntry::make('user.email')
                                    ->label('Email Address')
                                    ->copyable()
                                    ->icon('heroicon-m-envelope'),
                                TextEntry::make('user.phone')
                                    ->label('Phone Number')
                                    ->placeholder('Not provided')
                                    ->icon('heroicon-m-phone'),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('total_spent')
                                    ->label('Lifetime Gross Spend')
                                    ->state(fn (Customer $record): string => '₹' . number_format($record->totalSpent(), 2))
                                    ->weight('bold')
                                    ->color('success'),
                                TextEntry::make('orders_count')
                                    ->label('Completed Orders')
                                    ->state(fn (Customer $record): int => $record->orders()->count())
                                    ->badge()
                                    ->color('primary'),
                                TextEntry::make('user.created_at')
                                    ->label('Member Since')
                                    ->dateTime('M d, Y'),
                            ]),
                    ]),

                Section::make('Profile & Preferences')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('date_of_birth')
                                    ->label('Date of Birth')
                                    ->date('M d, Y')
                                    ->placeholder('Not set'),
                                TextEntry::make('gender')
                                    ->label('Gender')
                                    ->placeholder('Not specified')
                                    ->formatStateUsing(fn (?string $state): string => ucfirst($state ?? '')),
                            ]),
                        TextEntry::make('notes')
                            ->label('Client Care & Sommelier Notes')
                            ->placeholder('No specific preferences or dietary notes logged.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),
                TextColumn::make('orders_count')
                    ->counts('orders')
                    ->label('Orders')
                    ->sortable()
                    ->badge()
                    ->color('primary')
                    ->alignEnd(),
                TextColumn::make('total_spent')
                    ->label('Total Spent')
                    ->state(fn (Customer $record): string => '₹' . number_format($record->totalSpent(), 2))
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->withSum([
                            'orders as total_spent_sum' => fn ($q) => $q->where('status', '!=', OrderStatus::CANCELLED),
                        ], 'grand_total')->orderBy('total_spent_sum', $direction);
                    })
                    ->weight('bold')
                    ->color('success')
                    ->alignEnd(),
                TextColumn::make('user.created_at')
                    ->label('Joined Date')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->alignEnd(),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CustomerOrdersRelationManager::class,
            CustomerAddressesRelationManager::class,
            CustomerActivityRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomers::route('/'),
            'view' => ViewCustomer::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'addresses'])
            ->withCount('orders');
    }
}
