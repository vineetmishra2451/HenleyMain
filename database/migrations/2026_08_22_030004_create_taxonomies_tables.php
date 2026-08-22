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
        Schema::create('taxonomies', function (Blueprint $table): void {
            $table->id();
            $table->string('name'); // Benefit, Tea Type, Caffeine Level
            $table->string('slug')->unique(); // benefit, type, caffeine
            $table->integer('sort_order')->default(0);
            $table->boolean('is_filterable')->default(true)->index();
            $table->timestampsTz();
        });

        Schema::create('taxonomy_terms', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('taxonomy_id')->constrained('taxonomies')->cascadeOnDelete();
            $table->string('name'); // Immunity, Sleep, Energy, Relaxation, Focus, Detox, Green, Herbal, Black
            $table->string('slug');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestampsTz();

            $table->unique(['taxonomy_id', 'slug']);
            $table->index(['taxonomy_id', 'sort_order']);
        });

        Schema::create('product_taxonomy_term', function (Blueprint $table): void {
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('taxonomy_term_id')->constrained('taxonomy_terms')->cascadeOnDelete();
            $table->timestampsTz();

            $table->primary(['product_id', 'taxonomy_term_id']);
            $table->index('taxonomy_term_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_taxonomy_term');
        Schema::dropIfExists('taxonomy_terms');
        Schema::dropIfExists('taxonomies');
    }
};
