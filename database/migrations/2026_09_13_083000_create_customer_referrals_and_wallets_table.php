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
        Schema::table('users', function (Blueprint $table): void {
            $table->string('referral_code')->nullable()->unique()->after('remember_token');
            $table->decimal('wallet_balance', 12, 2)->default(0.00)->after('referral_code');
        });

        Schema::create('customer_referrals', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('referrer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('referee_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('referral_code')->index();
            $table->unsignedBigInteger('order_id')->nullable()->index();
            $table->decimal('cart_total', 12, 2)->default(0.00);
            $table->decimal('discount_given', 12, 2)->default(0.00); // 10% for referee
            $table->decimal('store_credit_awarded', 12, 2)->default(0.00); // 20% for referrer
            $table->string('status')->default('completed')->index(); // pending, completed, cancelled
            $table->timestampsTz();

            $table->index(['referrer_id', 'status']);
        });

        Schema::create('wallet_transactions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('type'); // credit, debit
            $table->decimal('amount', 12, 2);
            $table->decimal('balance_after', 12, 2);
            $table->string('description');
            $table->string('reference_id')->nullable()->index();
            $table->timestampsTz();

            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
        Schema::dropIfExists('customer_referrals');

        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['wallet_balance', 'referral_code']);
        });
    }
};
