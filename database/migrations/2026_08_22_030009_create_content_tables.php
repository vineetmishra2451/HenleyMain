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
        Schema::create('cms_pages', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('body');
            $table->boolean('is_published')->default(true)->index();
            $table->timestampTz('published_at')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });

        Schema::create('homepage_sections', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique(); // hero_banner, featured_collections, ritual_steps, pillars, journal_carousel
            $table->string('title');
            $table->string('type')->index(); // hero, grid, carousel, text_block, banner
            $table->integer('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->jsonb('payload'); // Flexible dynamic content schema
            $table->timestampsTz();
        });

        Schema::create('banners', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('placement')->index(); // storefront_hero, promo_strip, collection_banner
            $table->string('image_url');
            $table->string('link_url')->nullable();
            $table->timestampTz('starts_at')->nullable();
            $table->timestampTz('expires_at')->nullable()->index();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('sort_order')->default(0);
            $table->timestampsTz();
        });

        Schema::create('journal_posts', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('cover_image')->nullable();
            $table->string('author_name')->default('Henley Tea Masters');
            $table->unsignedSmallInteger('reading_time_minutes')->default(4);
            $table->boolean('is_published')->default(true)->index();
            $table->timestampTz('published_at')->nullable()->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->index(['is_published', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_posts');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('homepage_sections');
        Schema::dropIfExists('cms_pages');
    }
};
