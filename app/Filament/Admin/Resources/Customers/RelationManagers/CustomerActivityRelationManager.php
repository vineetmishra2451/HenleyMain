<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Customers\RelationManagers;

use App\Models\Customer;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\Activitylog\Models\Activity;

class CustomerActivityRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $title = 'Customer Activity Timeline';

    public function getRelationship(): Relation | Builder
    {
        $customer = $this->getOwnerRecord();
        $customerId = $customer->getKey();
        $userId = $customer->user_id;

        return Activity::query()
            ->where(function (Builder $q) use ($customerId, $userId) {
                $q->where(function (Builder $sub) use ($customerId) {
                    $sub->where('subject_type', Customer::class)
                        ->where('subject_id', $customerId);
                })->orWhere(function (Builder $sub) use ($userId) {
                    $sub->where('subject_type', User::class)
                        ->where('subject_id', $userId);
                })->orWhere(function (Builder $sub) use ($userId) {
                    $sub->where('causer_type', User::class)
                        ->where('causer_id', $userId);
                });
            })
            ->latest('id');
    }

    public function form(Schema $schema): Schema
    {
        return $schema;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->heading('Activity Audit Log')
            ->description('Historical events, account milestones, and authentication updates.')
            ->columns([
                TextColumn::make('description')
                    ->label('Event / Action')
                    ->weight('medium')
                    ->searchable(),
                TextColumn::make('log_name')
                    ->label('Context')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => ucfirst($state ?? 'System'))
                    ->color('primary'),
                TextColumn::make('causer')
                    ->label('Triggered By')
                    ->state(fn (Activity $record): string => $record->causer?->name ?? 'System Actor')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('created_at')
                    ->label('Timestamp')
                    ->dateTime('M d, Y H:i:s')
                    ->description(fn (Activity $record): string => $record->created_at?->diffForHumans() ?? '')
                    ->sortable(),
            ])
            ->emptyStateHeading('No customer activity logged yet')
            ->emptyStateDescription('Future profile updates, orders, and authentication events will appear here in chronological order.')
            ->paginated([10, 25, 50]);
    }
}
