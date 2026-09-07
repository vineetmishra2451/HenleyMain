<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Resources\Products;

use App\Enums\ProductStatus;
use App\Filament\Vendor\Resources\Products\Pages\CreateProduct;
use App\Filament\Vendor\Resources\Products\Pages\EditProduct;
use App\Filament\Vendor\Resources\Products\Pages\ListProducts;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use BackedEnum;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use UnitEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'products';

    protected static ?string $navigationLabel = 'Products';

    protected static ?int $navigationSort = 2;

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
                            ->placeholder('Brief sensory or terroir summary')
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
                                    ->label('Initial Stock Quantity')
                                    ->numeric()
                                    ->default(50)
                                    ->dehydrated(false)
                                    ->helperText('Stock units allocated to this harvest'),
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
                            ->helperText('Upload reserve harvest imagery or rely on Henley botanical placeholders.')
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
                        ProductStatus::DRAFT => 'warning',
                        ProductStatus::ARCHIVED => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('categories', 'name')
                    ->label('Filter by Category'),
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
                ReplicateAction::make()
                    ->label('Duplicate')
                    ->color('gray')
                    ->icon('heroicon-o-document-duplicate')
                    ->excludeAttributes(['search_vector'])
                    ->beforeReplicaSaved(function (Product $replica): void {
                        $vendorId = Auth::user()?->vendor_id;
                        unset($replica->search_vector);
                        $replica->name = $replica->name . ' (Copy)';
                        $replica->slug = $replica->slug . '-copy-' . strtolower(Str::random(4));
                        $replica->status = ProductStatus::DRAFT;
                        $replica->vendor_id = $vendorId;
                    })
                    ->after(function (Product $replica): void {
                        Notification::make()
                            ->title('Product Duplicated')
                            ->body("Draft copy created as {$replica->name}")
                            ->success()
                            ->send();
                    }),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
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
        $vendorId = Auth::user()?->vendor_id;

        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class])
            ->when($vendorId, fn (Builder $query) => $query->where('vendor_id', $vendorId))
            ->with(['categories', 'brand', 'variants.inventory']);
    }
}
