<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_metadatas', function (Blueprint $table): void {
            $table->id();
            $table->string('route_name')->unique();
            $table->string('path')->index();
            $table->string('meta_title');
            $table->text('meta_description')->nullable();
            $table->string('og_image_url')->nullable();
            $table->boolean('is_indexable')->default(true);
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_metadatas');
    }
};
