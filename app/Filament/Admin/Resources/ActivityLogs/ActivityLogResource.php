<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ActivityLogs;

use App\Filament\Admin\Resources\ActivityLogs\Pages\ListActivityLogs;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use UnitEnum;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $modelLabel = 'Audit Log';

    protected static ?string $pluralModelLabel = 'Audit & Activity Logs';

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Audit Event Metadata')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('log_name')
                                    ->label('Channel')
                                    ->disabled(),
                                TextInput::make('event')
                                    ->label('Event Type')
                                    ->disabled(),
                                TextInput::make('created_at')
                                    ->label('Logged Timestamp')
                                    ->disabled(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('causer.name')
                                    ->label('Initiating Actor')
                                    ->default('System / Automation')
                                    ->disabled(),
                                TextInput::make('subject_type')
                                    ->label('Target Domain Model')
                                    ->formatStateUsing(fn (?string $state, Activity $record): string => $state ? class_basename($state) . " (ID: {$record->subject_id})" : 'None')
                                    ->disabled(),
                            ]),
                        Textarea::make('description')
                            ->label('Audit Narrative')
                            ->disabled()
                            ->columnSpanFull(),
                        KeyValue::make('properties')
                            ->label('Payload State Changes (Old vs New)')
                            ->disabled()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Timestamp')
                    ->dateTime('d M Y, H:i:s')
                    ->description(fn (Activity $record): string => $record->created_at ? $record->created_at->diffForHumans() : '')
                    ->sortable(),
                TextColumn::make('causer.name')
                    ->label('Actor / User')
                    ->default('System')
                    ->weight('medium')
                    ->description(fn (Activity $record): string => $record->causer?->email ?? ($record->causer_type ? class_basename($record->causer_type) : 'Automated Trigger')),
                TextColumn::make('event')
                    ->label('Action')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        'auth' => 'info',
                        default => 'primary',
                    })
                    ->formatStateUsing(fn (?string $state): string => strtoupper($state ?? 'LOG')),
                TextColumn::make('subject_type')
                    ->label('Subject')
                    ->formatStateUsing(function (?string $state, Activity $record): string {
                        if (! $state) {
                            return '—';
                        }
                        $name = class_basename($state);
                        return $record->subject_id ? "{$name} #{$record->subject_id}" : $name;
                    })
                    ->badge()
                    ->color('gray'),
                TextColumn::make('description')
                    ->label('Narrative Summary')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('log_name')
                    ->label('Channel')
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('event')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                        'auth' => 'Authentication',
                    ]),
                SelectFilter::make('log_name')
                    ->options([
                        'default' => 'Default',
                        'auth' => 'Authentication',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()
                    ->modalHeading('Activity Event Inspection'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivityLogs::route('/'),
        ];
    }
}
