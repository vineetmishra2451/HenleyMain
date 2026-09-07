<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Customers\RelationManagers;

use App\Models\Address;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomerAddressesRelationManager extends RelationManager
{
    protected static string $relationship = 'addresses';

    protected static ?string $title = 'Customer Addresses';

    public function form(Schema $schema): Schema
    {
        return $schema;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('recipient_name')
            ->columns([
                TextColumn::make('recipient_name')
                    ->label('Recipient')
                    ->searchable()
                    ->weight('medium'),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                TextColumn::make('line_1')
                    ->label('Address')
                    ->description(fn (Address $record): string => ($record->line_2 ? $record->line_2 . ', ' : '') . $record->city . ', ' . $record->state . ' ' . $record->pincode)
                    ->wrap(),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->color('gray'),
                IconColumn::make('is_default_shipping')
                    ->label('Default Shipping')
                    ->boolean()
                    ->alignCenter(),
                IconColumn::make('is_default_billing')
                    ->label('Default Billing')
                    ->boolean()
                    ->alignCenter(),
            ]);
    }
}
