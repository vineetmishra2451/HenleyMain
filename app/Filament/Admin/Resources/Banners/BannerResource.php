<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Banners;

use App\Filament\Admin\Resources\Banners\Pages\CreateBanner;
use App\Filament\Admin\Resources\Banners\Pages\EditBanner;
use App\Filament\Admin\Resources\Banners\Pages\ListBanners;
use App\Models\Banner;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use UnitEnum;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $modelLabel = 'Storefront Banner';

    protected static ?string $pluralModelLabel = 'Storefront Banners';

    protected static string|UnitEnum|null $navigationGroup = 'CMS';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Banner Identity & Media')
                    ->description('Curate hero banners, promotional strips, and editorial announcements.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Banner Title / Caption')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('placement')
                                    ->label('Storefront Placement')
                                    ->required()
                                    ->options([
                                        'promo_strip' => 'Storewide Announcement Strip',
                                        'hero' => 'Homepage Hero Feature',
                                        'collection' => 'Collection Header Banner',
                                        'cart_drawer' => 'Cart Drawer Special Feature',
                                    ])
                                    ->default('promo_strip'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('image_url')
                                    ->label('Media Asset Path or URL')
                                    ->default('/images/brand/collectionpage.jpeg')
                                    ->helperText('Relative path to public image or external CDN URL.')
                                    ->required(),
                                TextInput::make('link_url')
                                    ->label('Target Destination URL')
                                    ->placeholder('/collections or /products/...'),
                            ]),
                    ]),

                Section::make('Scheduling & Visibility')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DateTimePicker::make('starts_at')
                                    ->label('Campaign Launch Time')
                                    ->default(now()),
                                DateTimePicker::make('expires_at')
                                    ->label('Campaign Expiry Time'),
                                TextInput::make('sort_order')
                                    ->label('Display Priority')
                                    ->numeric()
                                    ->default(1),
                            ]),
                        Toggle::make('is_active')
                            ->label('Active Campaign')
                            ->default(true)
                            ->helperText('When enabled and within date range, banner will appear on the storefront.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Preview')
                    ->square()
                    ->defaultImageUrl('/images/brand/collectionpage.jpeg'),
                TextColumn::make('title')
                    ->label('Banner Title')
                    ->weight('semibold')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('placement')
                    ->label('Placement')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'promo_strip' => 'Promo Strip',
                        'hero' => 'Hero Feature',
                        'collection' => 'Collection Header',
                        default => ucwords(str_replace('_', ' ', $state)),
                    }),
                TextColumn::make('link_url')
                    ->label('Destination')
                    ->fontFamily('mono')
                    ->color('gray')
                    ->limit(25),
                TextColumn::make('starts_at')
                    ->label('Active Window')
                    ->formatStateUsing(function (Banner $record): string {
                        $start = $record->starts_at ? $record->starts_at->format('d M Y') : 'Immediate';
                        $end = $record->expires_at ? $record->expires_at->format('d M Y') : 'Indefinite';
                        return "{$start} → {$end}";
                    })
                    ->color('gray'),
                ToggleColumn::make('is_active')
                    ->label('Active'),
            ])
            ->filters([
                SelectFilter::make('placement')
                    ->options([
                        'promo_strip' => 'Promo Strip',
                        'hero' => 'Hero Feature',
                        'collection' => 'Collection Header',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Campaign Status'),
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
            'index' => ListBanners::route('/'),
            'create' => CreateBanner::route('/create'),
            'edit' => EditBanner::route('/{record}/edit'),
        ];
    }
}
