<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Coupons;

use App\Enums\CouponType;
use App\Filament\Admin\Resources\Coupons\Pages\CreateCoupon;
use App\Filament\Admin\Resources\Coupons\Pages\EditCoupon;
use App\Filament\Admin\Resources\Coupons\Pages\ListCoupons;
use App\Models\Coupon;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use UnitEnum;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static string|UnitEnum|null $navigationGroup = 'Commerce';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTicket;

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Coupon Voucher Details')
                    ->description('Set redemption codes and promotional benefit rules.')
                    ->schema([
                        TextInput::make('code')
                            ->label('Voucher Code')
                            ->required()
                            ->maxLength(50)
                            ->unique(Coupon::class, 'code', ignoreRecord: true)
                            ->dehydrateStateUsing(fn (string $state): string => strtoupper($state))
                            ->extraInputAttributes(['style' => 'text-transform: uppercase; font-weight: bold; letter-spacing: 0.05em;'])
                            ->placeholder('e.g. BOTANICAL15'),
                        Grid::make(2)
                            ->schema([
                                Select::make('type')
                                    ->label('Discount Type')
                                    ->options([
                                        CouponType::PERCENTAGE->value => 'Percentage Discount (%)',
                                        CouponType::FIXED->value => 'Fixed Amount (₹)',
                                        CouponType::FREE_SHIPPING->value => 'Complimentary Free Shipping',
                                    ])
                                    ->required()
                                    ->default(CouponType::PERCENTAGE->value),
                                TextInput::make('value')
                                    ->label('Discount Value')
                                    ->numeric()
                                    ->required()
                                    ->helperText('Enter percentage discount (e.g. 15 for 15%) or rupee amount (e.g. 250).'),
                            ]),
                        TextInput::make('min_order_amount')
                            ->label('Minimum Order Amount')
                            ->numeric()
                            ->prefix('₹')
                            ->placeholder('e.g. 1500.00')
                            ->helperText('Cart subtotal threshold required for redemption eligibility.'),
                    ])->columns(2),

                Section::make('Usage Limits & Redemptions')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('usage_limit_total')
                                    ->label('Total Redemptions Allowed')
                                    ->numeric()
                                    ->placeholder('Unlimited if left blank'),
                                TextInput::make('usage_limit_per_customer')
                                    ->label('Per-Customer Limit')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                DateTimePicker::make('starts_at')
                                    ->label('Activation Date'),
                                DateTimePicker::make('expires_at')
                                    ->label('Expiry Date')
                                    ->helperText('Vouchers automatically become inactive after this date.'),
                            ]),
                        Toggle::make('is_active')
                            ->label('Active Campaign Status')
                            ->default(true)
                            ->helperText('Disable to immediately halt client redemptions across storefront checkout.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('discount')
                    ->label('Discount')
                    ->state(fn (Coupon $record): string => match ($record->type) {
                        CouponType::PERCENTAGE => "{$record->value}% OFF",
                        CouponType::FIXED => '₹' . number_format((float) $record->value, 2),
                        CouponType::FREE_SHIPPING => 'Free Shipping',
                        default => (string) $record->value,
                    })
                    ->badge()
                    ->color(fn (Coupon $record): string => match ($record->type) {
                        CouponType::PERCENTAGE => 'primary',
                        CouponType::FIXED => 'success',
                        CouponType::FREE_SHIPPING => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('usage')
                    ->label('Usage / Limit')
                    ->state(fn (Coupon $record): string => $record->total_uses . ' / ' . ($record->usage_limit_total ? (string) $record->usage_limit_total : '∞'))
                    ->badge()
                    ->color('gray')
                    ->alignEnd(),
                TextColumn::make('expires_at')
                    ->label('Expiry Date')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->placeholder('No Expiration'),
                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->alignCenter(),
                TextColumn::make('status')
                    ->label('Validity')
                    ->badge()
                    ->state(function (Coupon $record): string {
                        if ($record->expires_at && $record->expires_at->isPast()) {
                            return 'Expired';
                        }
                        return $record->is_active ? 'Active' : 'Inactive';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Expired' => 'danger',
                        'Active' => 'success',
                        'Inactive' => 'gray',
                        default => 'gray',
                    })
                    ->alignCenter(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        CouponType::PERCENTAGE->value => 'Percentage',
                        CouponType::FIXED->value => 'Fixed Amount',
                        CouponType::FREE_SHIPPING->value => 'Free Shipping',
                    ]),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCoupons::route('/'),
            'create' => CreateCoupon::route('/create'),
            'edit' => EditCoupon::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
