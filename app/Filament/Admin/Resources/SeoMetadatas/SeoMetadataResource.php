<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\SeoMetadatas;

use App\Filament\Admin\Resources\SeoMetadatas\Pages\CreateSeoMetadata;
use App\Filament\Admin\Resources\SeoMetadatas\Pages\EditSeoMetadata;
use App\Filament\Admin\Resources\SeoMetadatas\Pages\ListSeoMetadatas;
use App\Models\SeoMetadata;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use UnitEnum;

class SeoMetadataResource extends Resource
{
    protected static ?string $model = SeoMetadata::class;

    protected static ?string $modelLabel = 'SEO Metadata';

    protected static ?string $pluralModelLabel = 'SEO Route Metadatas';

    protected static ?string $slug = 'seo-metadatas';

    protected static string|UnitEnum|null $navigationGroup = 'CMS';

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    protected static ?string $recordTitleAttribute = 'route_name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Route Target & Identification')
                    ->description('Map Open Graph and Meta Tags to storefront routes.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('route_name')
                                    ->label('System Route Name')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('e.g. home, collections.index, about'),
                                TextInput::make('path')
                                    ->label('Public URL Path')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g. /, /collections, /about'),
                            ]),
                        Toggle::make('is_indexable')
                            ->label('Allow Search Indexing (index, follow)')
                            ->default(true)
                            ->helperText('When disabled, adds noindex, nofollow robots tags.'),
                    ]),

                Section::make('Social Cards & Search Engine Preview')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Henley Botanicals — Pure Leaf. Pure Intent.'),
                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(500)
                            ->placeholder('High-altitude botanical infusions, single-estate teas...'),
                        TextInput::make('og_image_url')
                            ->label('Social Share (OG) Image URL')
                            ->placeholder('/images/brand/homepage.jpeg')
                            ->helperText('Optimal dimensions: 1200 x 630 px. Relative path or full URL.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('og_image_url')
                    ->label('Social Card')
                    ->square()
                    ->defaultImageUrl('/images/brand/homepage.jpeg'),
                TextColumn::make('route_name')
                    ->label('Route')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('path')
                    ->label('Path')
                    ->fontFamily('mono')
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('meta_title')
                    ->label('Meta Title')
                    ->weight('semibold')
                    ->searchable()
                    ->wrap(),
                ToggleColumn::make('is_indexable')
                    ->label('Indexable'),
                TextColumn::make('updated_at')
                    ->label('Last Synced')
                    ->since()
                    ->color('gray'),
            ])
            ->filters([
                TernaryFilter::make('is_indexable')
                    ->label('Indexing Status'),
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
            'index' => ListSeoMetadatas::route('/'),
            'create' => CreateSeoMetadata::route('/create'),
            'edit' => EditSeoMetadata::route('/{record}/edit'),
        ];
    }
}
