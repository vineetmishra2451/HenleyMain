<?php

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
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('fulfillment_status')->default('pending')->index();
        });

        // Backfill existing order items based on parent order status
        DB::statement("
            UPDATE order_items 
            SET fulfillment_status = CASE 
                WHEN orders.status = 'delivered' THEN 'delivered' 
                WHEN orders.status = 'shipped' THEN 'shipped' 
                WHEN orders.status = 'processing' THEN 'processing' 
                WHEN orders.status = 'cancelled' THEN 'cancelled' 
                ELSE 'pending' 
            END
            FROM orders 
            WHERE order_items.order_id = orders.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('fulfillment_status');
        });
    }
};
