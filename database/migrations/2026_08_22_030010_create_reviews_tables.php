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
        Schema::create('reviews', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->string('customer_name');
            $table->unsignedTinyInteger('rating'); // 1 to 5
            $table->string('title')->nullable();
            $table->text('body');
            $table->boolean('is_verified_purchase')->default(false)->index();
            $table->string('status')->default('approved')->index(); // ReviewStatus: pending, approved, rejected
            $table->timestampTz('published_at')->nullable()->index();
            $table->timestampsTz();

            $table->index(['product_id', 'status', 'rating']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
