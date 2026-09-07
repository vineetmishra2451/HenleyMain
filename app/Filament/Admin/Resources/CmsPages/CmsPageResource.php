<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\CmsPages;

use App\Filament\Admin\Resources\CmsPages\Pages\CreateCmsPage;
use App\Filament\Admin\Resources\CmsPages\Pages\EditCmsPage;
use App\Filament\Admin\Resources\CmsPages\Pages\ListCmsPages;
use App\Models\CmsPage;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use UnitEnum;

class CmsPageResource extends Resource
{
    protected static ?string $model = CmsPage::class;

    protected static ?string $modelLabel = 'Editorial Page';

    protected static ?string $pluralModelLabel = 'Editorial Pages';

    protected static string|UnitEnum|null $navigationGroup = 'CMS';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page Content')
                    ->description('Author core editorial pages such as About, Philosophy, Sourcing, and Legal policies.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Page Title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, ?string $state, callable $set): void {
                                        if ($operation === 'create') {
                                            $set('slug', Str::slug($state ?? ''));
                                        }
                                    }),
                                TextInput::make('slug')
                                    ->label('URL Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(CmsPage::class, 'slug', ignoreRecord: true)
                                    ->prefix('/page/'),
                            ]),
                        RichEditor::make('body')
                            ->label('Rich Text Content')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Publishing & SEO Metadata')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_published')
                                    ->label('Published to Storefront')
                                    ->default(true)
                                    ->helperText('Visible to storefront shoppers when enabled.'),
                                DateTimePicker::make('published_at')
                                    ->label('Publication Date')
                                    ->default(now()),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('seo_title')
                                    ->label('SEO Meta Title')
                                    ->maxLength(255)
                                    ->placeholder('Default: Page Title — Henley Botanicals'),
                                Textarea::make('seo_description')
                                    ->label('SEO Meta Description')
                                    ->maxLength(500)
                                    ->rows(3),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->description(fn (CmsPage $record): string => "/page/{$record->slug}"),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->fontFamily('mono')
                    ->color('gray')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('is_published')
                    ->label('Published'),
                TextColumn::make('published_at')
                    ->label('Published Date')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Last Revised')
                    ->since()
                    ->sortable()
                    ->color('gray'),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Publication Status')
                    ->trueLabel('Published')
                    ->falseLabel('Draft / Hidden'),
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
            'index' => ListCmsPages::route('/'),
            'create' => CreateCmsPage::route('/create'),
            'edit' => EditCmsPage::route('/{record}/edit'),
        ];
    }
}
