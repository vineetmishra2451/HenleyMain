<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('session_token')->nullable()->index();
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->nullOnDelete();
            $table->timestampTz('expires_at')->nullable()->index();
            $table->timestampsTz();

            $table->index(['user_id', 'session_token']);
        });

        Schema::create('cart_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->cascadeOnDelete();
            $table->foreignId('product_variant_id')->constrained('product_variants')->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->jsonb('custom_options')->nullable();
            $table->timestampsTz();

            $table->unique(['cart_id', 'product_variant_id']);
        });

        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->string('order_number')->unique(); // e.g. "HNL-2026-1042"
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->jsonb('customer_snapshot'); // name, email, phone at time of purchase
            $table->jsonb('shipping_address');  // Immutable snapshot
            $table->jsonb('billing_address');   // Immutable snapshot
            $table->decimal('subtotal', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0.00);
            $table->decimal('tax_amount', 12, 2)->default(0.00);
            $table->decimal('shipping_amount', 12, 2)->default(0.00);
            $table->decimal('grand_total', 12, 2);
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->nullOnDelete();
            $table->string('status')->default('pending')->index(); // OrderStatus enum
            $table->string('payment_status')->default('pending')->index(); // PaymentStatus enum
            $table->string('currency', 3)->default('INR');
            $table->timestampTz('placed_at')->useCurrent()->index();
            $table->timestampTz('fulfilled_at')->nullable();
            $table->timestampTz('cancelled_at')->nullable();
            $table->text('customer_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestampsTz();

            // Composite indexes for fast search and operational queues
            $table->index(['status', 'payment_status', 'placed_at']);
            $table->index(['user_id', 'placed_at']);
        });

        Schema::create('order_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('product_variant_id')->nullable()->constrained('product_variants')->nullOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete(); // Denormalised for vendor queries
            $table->string('product_name');
            $table->string('variant_label');
            $table->string('sku');
            $table->decimal('unit_price', 12, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('line_tax', 12, 2)->default(0.00);
            $table->decimal('line_discount', 12, 2)->default(0.00);
            $table->decimal('line_total', 12, 2);
            $table->timestampsTz();

            $table->index(['vendor_id', 'order_id']);
            $table->index(['order_id', 'product_id']);
        });

        Schema::create('payments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('payment_number')->unique(); // e.g. "PAY-2026-1042"
            $table->string('gateway')->default('razorpay'); // razorpay, cod
            $table->string('gateway_order_id')->nullable()->index();
            $table->string('gateway_payment_id')->nullable()->index();
            $table->string('gateway_signature')->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('INR');
            $table->string('status')->default('pending')->index(); // PaymentStatus enum
            $table->string('payment_method')->nullable(); // upi, card, netbanking
            $table->jsonb('payload')->nullable(); // raw gateway callback response
            $table->timestampTz('captured_at')->nullable();
            $table->timestampsTz();

            $table->index(['order_id', 'status']);
        });

        Schema::create('refunds', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('payment_id')->nullable()->constrained('payments')->nullOnDelete();
            $table->string('refund_number')->unique(); // e.g. "RFD-2026-1042"
            $table->string('gateway_refund_id')->nullable()->index();
            $table->decimal('amount', 12, 2);
            $table->text('reason');
            $table->string('status')->default('pending')->index(); // RefundStatus enum
            $table->timestampTz('processed_at')->nullable();
            $table->timestampsTz();
        });

        Schema::create('shipments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $table->string('shipment_number')->unique(); // e.g. "SHP-2026-1042"
            $table->string('courier_name'); // Delhivery, BlueDart, Bluedart Apex
            $table->string('tracking_number')->index();
            $table->string('tracking_url')->nullable();
            $table->string('status')->default('pending')->index(); // ShipmentStatus enum
            $table->timestampTz('shipped_at')->nullable();
            $table->timestampTz('delivered_at')->nullable();
            $table->timestampsTz();

            $table->index(['order_id', 'status']);
            $table->index(['vendor_id', 'status']);
        });

        // Add foreign key constraint to coupon_redemptions now that orders exists
        Schema::table('coupon_redemptions', function (Blueprint $table): void {
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupon_redemptions', function (Blueprint $table): void {
            $table->dropForeign(['order_id']);
        });

        Schema::dropIfExists('shipments');
        Schema::dropIfExists('refunds');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};
