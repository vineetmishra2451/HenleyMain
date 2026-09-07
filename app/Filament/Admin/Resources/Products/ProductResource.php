<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products;

use App\Enums\ProductStatus;
use App\Filament\Admin\Resources\Products\Pages\CreateProduct;
use App\Filament\Admin\Resources\Products\Pages\EditProduct;
use App\Filament\Admin\Resources\Products\Pages\ListProducts;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|UnitEnum|null $navigationGroup = 'Catalog';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, callable $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state ?? ''));
                                }
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord: true),
                        Grid::make(2)
                            ->schema([
                                Select::make('categories')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->label('Categories'),
                                Select::make('brand_id')
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->label('Brand'),
                            ]),
                        Textarea::make('short_description')
                            ->rows(2)
                            ->label('Short Description')
                            ->placeholder('Brief sensory or botanical summary')
                            ->columnSpanFull(),
                        RichEditor::make('description')
                            ->label('Full Description')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Pricing and Inventory')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('base_price')
                                    ->label('Price')
                                    ->numeric()
                                    ->prefix('₹')
                                    ->required(),
                                TextInput::make('compare_at_price')
                                    ->label('Compare-at Price')
                                    ->numeric()
                                    ->prefix('₹'),
                                TextInput::make('inventory_quantity')
                                    ->label('Inventory Quantity')
                                    ->numeric()
                                    ->default(0)
                                    ->dehydrated(false)
                                    ->helperText('Initial standard variant stock'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        ProductStatus::PUBLISHED->value => 'Active (Published)',
                                        ProductStatus::DRAFT->value => 'Draft',
                                        ProductStatus::ARCHIVED->value => 'Archived',
                                    ])
                                    ->default(ProductStatus::PUBLISHED->value)
                                    ->required(),
                                Toggle::make('is_featured')
                                    ->label('Featured in Catalog')
                                    ->inline(false),
                            ]),
                    ]),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Product Images')
                            ->multiple()
                            ->image()
                            ->helperText('Upload product imagery or rely on default botanical placeholders.')
                            ->dehydrated(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->state(function (Product $record): string {
                        $url = $record->primary_image;
                        if ($url && file_exists(public_path($url))) {
                            return asset($url);
                        }
                        return asset('placeholders/product_square-0.svg');
                    })
                    ->square(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->description(fn (Product $record): ?string => $record->slug),
                TextColumn::make('categories.name')
                    ->label('Category')
                    ->badge()
                    ->color('gray')
                    ->separator(', '),
                TextColumn::make('brand.name')
                    ->label('Brand')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Henley Private Reserve'),
                TextColumn::make('base_price')
                    ->label('Price')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Stock')
                    ->state(fn (Product $record): int => (int) $record->variants->sum(fn ($v) => $v->inventory?->quantity_on_hand ?? 0))
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state instanceof ProductStatus ? $state : ProductStatus::tryFrom((string) $state)) {
                        ProductStatus::PUBLISHED => 'Active',
                        ProductStatus::DRAFT => 'Draft',
                        ProductStatus::ARCHIVED => 'Archived',
                        default => (string) $state,
                    })
                    ->color(fn ($state): string => match ($state instanceof ProductStatus ? $state : ProductStatus::tryFrom((string) $state)) {
                        ProductStatus::PUBLISHED => 'success',
                        ProductStatus::DRAFT => 'gray',
                        ProductStatus::ARCHIVED => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('categories', 'name')
                    ->preload(),
                SelectFilter::make('brand')
                    ->relationship('brand', 'name')
                    ->preload(),
                SelectFilter::make('status')
                    ->options([
                        ProductStatus::PUBLISHED->value => 'Active',
                        ProductStatus::DRAFT->value => 'Draft',
                        ProductStatus::ARCHIVED->value => 'Archived',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation(),
                ReplicateAction::make()
                    ->label('Duplicate')
                    ->excludeAttributes(['search_vector'])
                    ->beforeReplicaSaved(function (Product $replica): void {
                        $replica->name = $replica->name . ' (Copy)';
                        $replica->slug = $replica->slug . '-copy-' . strtolower(Str::random(4));
                        $replica->status = ProductStatus::DRAFT;
                    })
                    ->after(function (Product $replica, Product $record): void {
                        $replica->categories()->sync($record->categories->pluck('id'));
                        Notification::make()
                            ->title('Product Duplicated')
                            ->body("Created draft copy {$replica->name}")
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['primaryImage', 'images', 'categories', 'brand', 'variants.inventory']);
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
