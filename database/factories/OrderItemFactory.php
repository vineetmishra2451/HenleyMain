<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $unitPrice = 1200.00;
        $qty = 1;
        $tax = round($unitPrice * 0.05, 2);
        $total = $unitPrice * $qty;

        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'product_variant_id' => ProductVariant::factory(),
            'vendor_id' => Vendor::factory(),
            'product_name' => 'First Flush Darjeeling Castleton Estate',
            'variant_label' => '100g Porcelain Cloche Jar',
            'sku' => 'HNL-DAR-100G',
            'unit_price' => $unitPrice,
            'quantity' => $qty,
            'line_tax' => $tax,
            'line_discount' => 0.00,
            'line_total' => $total,
        ];
    }
}
