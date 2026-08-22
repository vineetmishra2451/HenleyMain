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
        Schema::create('customers', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('avatar_url')->nullable();
            $table->jsonb('preferences')->nullable();
            $table->text('notes')->nullable();
            $table->timestampsTz();
        });

        Schema::create('addresses', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('recipient_name');
            $table->string('phone');
            $table->string('line_1');
            $table->string('line_2')->nullable();
            $table->string('landmark')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('pincode', 10)->index();
            $table->string('country', 2)->default('IN');
            $table->string('type')->default('home'); // home, work, other
            $table->boolean('is_default_shipping')->default(false);
            $table->boolean('is_default_billing')->default(false);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestampsTz();

            $table->index(['customer_id', 'is_default_shipping']);
            $table->index(['customer_id', 'is_default_billing']);
        });

        Schema::create('otp_codes', function (Blueprint $table): void {
            $table->id();
            $table->string('identifier')->index(); // email or phone
            $table->string('code');
            $table->string('type')->default('login'); // login, password_reset, phone_verification
            $table->timestampTz('expires_at');
            $table->timestampTz('verified_at')->nullable();
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->timestampsTz();

            $table->index(['identifier', 'code', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_codes');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('customers');
    }
};
