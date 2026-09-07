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
        Schema::table('homepage_sections', function (Blueprint $table): void {
            if (! Schema::hasColumn('homepage_sections', 'label')) {
                $table->string('label')->nullable()->after('key');
            }
            if (! Schema::hasColumn('homepage_sections', 'active')) {
                $table->boolean('active')->default(true)->index()->after('sort_order');
            }
        });

        if (Schema::hasTable('homepage_sections')) {
            DB::statement('UPDATE homepage_sections SET label = title WHERE label IS NULL AND title IS NOT NULL');
            DB::statement('UPDATE homepage_sections SET active = is_active WHERE active IS NULL AND is_active IS NOT NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homepage_sections', function (Blueprint $table): void {
            if (Schema::hasColumn('homepage_sections', 'label')) {
                $table->dropColumn('label');
            }
            if (Schema::hasColumn('homepage_sections', 'active')) {
                $table->dropColumn('active');
            }
        });
    }
};
