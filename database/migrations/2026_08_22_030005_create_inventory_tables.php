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
        Schema::create('inventories', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_variant_id')->unique()->constrained('product_variants')->cascadeOnDelete();
            $table->integer('quantity_on_hand')->default(0);
            $table->integer('quantity_reserved')->default(0);
            $table->integer('low_stock_threshold')->default(5);
            $table->string('warehouse_location')->nullable(); // e.g. "Aisle 4, Bin 12 - Siliguri Vault"
            $table->timestampsTz();

            $table->index('product_variant_id');
        });

        // Append-only stock movements ledger (never deleted or modified)
        Schema::create('stock_movements', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_variant_id')->constrained('product_variants')->cascadeOnDelete();
            $table->string('reason'); // initial_stock, order_placed, order_cancelled, restock, manual_adjustment, damaged, return_restock
            $table->integer('quantity_delta'); // e.g. +50 or -2
            $table->integer('balance_after'); // reconcilable snapshot
            $table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('reference_type')->nullable(); // e.g. App\Models\Order
            $table->string('reference_id')->nullable();   // e.g. Order #1042
            $table->text('notes')->nullable();
            $table->timestampTz('created_at')->useCurrent()->index();

            $table->index(['product_variant_id', 'created_at']);
            $table->index('reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
        Schema::dropIfExists('inventories');
    }
};
