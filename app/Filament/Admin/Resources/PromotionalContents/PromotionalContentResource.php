<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\PromotionalContents;

use App\Filament\Admin\Resources\PromotionalContents\Pages\CreatePromotionalContent;
use App\Filament\Admin\Resources\PromotionalContents\Pages\EditPromotionalContent;
use App\Filament\Admin\Resources\PromotionalContents\Pages\ListPromotionalContents;
use App\Models\PromotionalContent;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class PromotionalContentResource extends Resource
{
    protected static ?string $model = PromotionalContent::class;

    protected static ?string $modelLabel = 'Promotional Content';

    protected static ?string $pluralModelLabel = 'Promotional Content';

    protected static string|UnitEnum|null $navigationGroup = 'CMS';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Campaign Copy & Offers Band')
                    ->description('Curate copy, headline hooks, and coupon integrations for storefront promotional ribbons.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Campaign Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, ?string $state, callable $set): void {
                                        if ($operation === 'create') {
                                            $set('key', Str::slug($state ?? '', '_'));
                                        }
                                    }),
                                TextInput::make('key')
                                    ->label('Identifier Key')
                                    ->required()
                                    ->maxLength(100)
                                    ->unique(PromotionalContent::class, 'key', ignoreRecord: true),
                                Select::make('placement')
                                    ->label('Storefront Placement')
                                    ->required()
                                    ->options([
                                        'header_ribbon' => 'Header Announcement Ribbon',
                                        'cart_drawer' => 'Cart Drawer Offers Band',
                                        'checkout_summary' => 'Checkout Summary Guarantee',
                                        'collection_header' => 'Collection Header Highlight',
                                    ])
                                    ->default('header_ribbon'),
                            ]),
                        TextInput::make('headline')
                            ->label('Promotional Headline')
                            ->placeholder('e.g. Enjoy 10% privilege on your first harvest collection')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        RichEditor::make('body')
                            ->label('Detailed Body Copy / Terms')
                            ->columnSpanFull(),
                    ]),

                Section::make('Incentives & Call-To-Action')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('coupon_code')
                                    ->label('Linked Voucher Code')
                                    ->placeholder('e.g. RITUAL10')
                                    ->dehydrateStateUsing(fn (?string $state): ?string => $state ? strtoupper($state) : null),
                                TextInput::make('button_label')
                                    ->label('CTA Button Text')
                                    ->placeholder('e.g. Claim Privilege'),
                                TextInput::make('button_url')
                                    ->label('CTA Link Destination')
                                    ->placeholder('/collections'),
                            ]),
                        Toggle::make('is_active')
                            ->label('Active Campaign')
                            ->default(true)
                            ->helperText('Visible across designated storefront touchpoints when active.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Campaign')
                    ->weight('semibold')
                    ->searchable()
                    ->description(fn (PromotionalContent $record): string => "Key: {$record->key}"),
                TextColumn::make('placement')
                    ->label('Placement')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'header_ribbon' => 'Header Ribbon',
                        'cart_drawer' => 'Cart Drawer',
                        'checkout_summary' => 'Checkout Guarantee',
                        'collection_header' => 'Collection Header',
                        default => ucwords(str_replace('_', ' ', $state)),
                    }),
                TextColumn::make('headline')
                    ->label('Headline')
                    ->limit(45)
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('coupon_code')
                    ->label('Voucher')
                    ->badge()
                    ->color('warning')
                    ->default('—'),
                ToggleColumn::make('is_active')
                    ->label('Active'),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->color('gray'),
            ])
            ->filters([
                SelectFilter::make('placement')
                    ->options([
                        'header_ribbon' => 'Header Ribbon',
                        'cart_drawer' => 'Cart Drawer',
                        'checkout_summary' => 'Checkout Guarantee',
                        'collection_header' => 'Collection Header',
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
            'index' => ListPromotionalContents::route('/'),
            'create' => CreatePromotionalContent::route('/create'),
            'edit' => EditPromotionalContent::route('/{record}/edit'),
        ];
    }
}
