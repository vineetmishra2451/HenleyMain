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
        Schema::create('coupons', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('type'); // fixed, percentage, free_shipping
            $table->decimal('value', 12, 2); // ₹ amount or % discount
            $table->decimal('min_order_amount', 12, 2)->nullable();
            $table->decimal('max_discount_amount', 12, 2)->nullable();
            $table->unsignedInteger('usage_limit_total')->nullable();
            $table->unsignedInteger('usage_limit_per_customer')->nullable()->default(1);
            $table->unsignedInteger('total_uses')->default(0);
            $table->string('applicability_scope')->default('all'); // all, category, product, brand
            $table->jsonb('scope_ids')->nullable(); // array of matching category/product/brand IDs
            $table->timestampTz('starts_at')->nullable();
            $table->timestampTz('expires_at')->nullable()->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->index(['code', 'is_active']);
        });

        Schema::create('coupon_redemptions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('coupon_id')->constrained('coupons')->cascadeOnDelete();
            $table->unsignedBigInteger('order_id')->index(); // FK added in commerce migration
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('discount_amount', 12, 2);
            $table->timestampTz('redeemed_at')->useCurrent()->index();

            $table->index(['coupon_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_redemptions');
        Schema::dropIfExists('coupons');
    }
};
