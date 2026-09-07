<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\HomepageSections;

use App\Filament\Admin\Resources\HomepageSections\Pages\EditHomepageSection;
use App\Filament\Admin\Resources\HomepageSections\Pages\ListHomepageSections;
use App\Models\HomepageSection;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

class HomepageSectionResource extends Resource
{
    protected static ?string $model = HomepageSection::class;

    protected static ?string $modelLabel = 'Homepage Section';

    protected static ?string $pluralModelLabel = 'Homepage Sections';

    protected static string|UnitEnum|null $navigationGroup = 'CMS';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Section Layout & Identification')
                    ->description('Organize and configure content blocks on the storefront landing page.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Editorial Section Title')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('key')
                                    ->label('System Unique Key')
                                    ->required()
                                    ->maxLength(100)
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('type')
                                    ->label('Section Type')
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(),
                                TextInput::make('sort_order')
                                    ->label('Display Order')
                                    ->numeric()
                                    ->required()
                                    ->default(1),
                                Toggle::make('is_active')
                                    ->label('Display on Homepage')
                                    ->default(true)
                                    ->helperText('Toggles rendering on the public landing page.'),
                            ]),
                        KeyValue::make('payload')
                            ->label('Section Configuration & Copy Payload')
                            ->helperText('Configurable attributes such as headline, eyebrow, CTA label, and URL.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
            ->paginated(false)
            ->columns([
                TextColumn::make('sort_order')
                    ->label('Seq')
                    ->badge()
                    ->color('primary')
                    ->alignCenter(),
                TextColumn::make('title')
                    ->label('Section Title')
                    ->weight('semibold')
                    ->searchable()
                    ->description(fn (HomepageSection $record): string => "Identifier: {$record->key}"),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
                ToggleColumn::make('is_active')
                    ->label('Active on Storefront')
                    ->afterStateUpdated(function (HomepageSection $record, bool $state): void {
                        $record->active = $state;
                        $record->saveQuietly();
                    }),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->color('gray'),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomepageSections::route('/'),
            'edit' => EditHomepageSection::route('/{record}/edit'),
        ];
    }
}
