<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0)->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->string('image_path')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });

        Schema::create('brands', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo_path')->nullable();
            $table->text('description')->nullable();
            $table->string('website_url')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });

        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->text('description');
            $table->text('ingredients')->nullable();
            $table->text('brewing_guide')->nullable();
            $table->string('status')->default('draft')->index(); // draft, published, archived
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_bestseller')->default(false)->index();
            $table->decimal('base_price', 12, 2);
            $table->decimal('compare_at_price', 12, 2)->nullable();
            $table->decimal('tax_rate_percent', 5, 2)->default(5.00);
            $table->integer('weight_grams')->nullable();
            $table->jsonb('dimensions')->nullable(); // length, width, height
            $table->decimal('rating_average', 3, 2)->default(0.00)->index();
            $table->unsignedInteger('rating_count')->default(0);
            $table->timestampTz('published_at')->nullable()->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->jsonb('metadata')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();

            // Query optimization indexes
            $table->index(['vendor_id', 'status']);
            $table->index(['status', 'published_at']);
            $table->index(['status', 'is_featured']);
            $table->index(['status', 'is_bestseller']);
        });

        // Add PostgreSQL Full-Text Search tsvector generated column & GIN index
        if (DB::getDriverName() === 'pgsql') {
            DB::statement("
                ALTER TABLE products ADD COLUMN search_vector tsvector GENERATED ALWAYS AS (
                    setweight(to_tsvector('english', coalesce(name, '')), 'A') ||
                    setweight(to_tsvector('english', coalesce(short_description, '')), 'B') ||
                    setweight(to_tsvector('english', coalesce(description, '')), 'C') ||
                    setweight(to_tsvector('english', coalesce(ingredients, '')), 'D')
                ) STORED;
            ");
            DB::statement('CREATE INDEX products_search_vector_idx ON products USING GIN (search_vector);');
        }

        Schema::create('category_product', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->timestampsTz();

            $table->unique(['category_id', 'product_id']);
        });

        Schema::create('product_variants', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->string('option_label'); // e.g. "100g Porcelain Jar", "250g Botanical Refill"
            $table->decimal('price', 12, 2);
            $table->decimal('compare_at_price', 12, 2)->nullable();
            $table->integer('weight_grams');
            $table->string('barcode')->nullable()->index();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true)->index();
            $table->timestampsTz();

            $table->index(['product_id', 'is_active', 'sort_order']);
        });

        Schema::create('product_attributes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('key')->index(); // e.g. "caffeine_level", "origin_estate", "harvest_season"
            $table->string('value');
            $table->integer('sort_order')->default(0);
            $table->timestampsTz();

            $table->index(['product_id', 'key']);
        });

        Schema::create('product_images', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('product_variant_id')->nullable()->constrained('product_variants')->nullOnDelete();
            $table->string('url');
            $table->string('alt_text')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_primary')->default(false)->index();
            $table->timestampsTz();

            $table->index(['product_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('products');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('categories');
    }
};
