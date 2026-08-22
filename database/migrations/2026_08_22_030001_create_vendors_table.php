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
        Schema::create('vendors', function (Blueprint $table): void {
            $table->id();
            $table->string('business_name');
            $table->string('legal_name')->nullable();
            $table->string('slug')->unique();
            $table->string('gstin')->nullable()->index();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->jsonb('address')->nullable();
            $table->decimal('commission_rate', 5, 2)->default(15.00); // e.g. 15.00%
            $table->string('status')->default('pending')->index();
            $table->timestampTz('approved_at')->nullable();
            $table->jsonb('bank_details')->nullable();
            $table->text('notes')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->index(['status', 'created_at']);
        });

        Schema::table('users', function (Blueprint $table): void {
            $table->foreignId('vendor_id')->nullable()->after('role')->constrained('vendors')->nullOnDelete();
            $table->index('vendor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn('vendor_id');
        });

        Schema::dropIfExists('vendors');
    }
};
