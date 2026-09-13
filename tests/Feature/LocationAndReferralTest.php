<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\CustomerReferral;
use App\Models\Setting;
use App\Models\User;
use App\Services\PostalLocationService;
use App\Services\ReferralProgramService;

test('postal location service validates 6-digit metro pincodes with express delivery', function (): void {
    $service = app(PostalLocationService::class);

    // Metro PIN (Mumbai)
    $result = $service->checkPincode('400050');
    expect($result['serviceable'])->toBeTrue()
        ->and($result['city'])->toBe('Mumbai')
        ->and($result['zone'])->toBe('metro')
        ->and($result['express_available'])->toBeTrue()
        ->and($result['cod_available'])->toBeTrue();

    // Invalid PIN format
    $invalid = $service->checkPincode('ABC12');
    expect($invalid['serviceable'])->toBeFalse()
        ->and($invalid['message'])->toContain('valid 6-digit');
});

test('postal location service respects admin blocked pincodes list', function (): void {
    // Configure blocked pincode in settings
    Setting::updateOrCreate(
        ['key' => 'blocked_pincodes'],
        ['group' => 'shipping', 'value' => "190001, 795001\n796001", 'type' => 'string']
    );

    $service = app(PostalLocationService::class);

    $blocked = $service->checkPincode('190001');
    expect($blocked['serviceable'])->toBeFalse()
        ->and($blocked['zone'])->toBe('blocked')
        ->and($blocked['message'])->toContain('currently unavailable');

    // Clean up setting
    Setting::where('key', 'blocked_pincodes')->delete();
});

test('api endpoint /api/check-pincode returns json verification', function (): void {
    $response = $this->getJson('/api/check-pincode?pincode=560001');

    $response->assertSuccessful()
        ->assertJson([
            'serviceable' => true,
            'city' => 'Bengaluru',
            'zone' => 'metro',
        ]);
});

test('referral service requires cart total above 500 for referee discount', function (): void {
    $user = User::factory()->create([
        'referral_code' => 'HENLEY-TESTREF-1',
        'wallet_balance' => 0.00,
    ]);

    $service = app(ReferralProgramService::class);

    // Below ₹500 threshold
    $below = $service->validateCode('HENLEY-TESTREF-1', 450.00);
    expect($below['valid'])->toBeFalse()
        ->and($below['message'])->toContain('above ₹500');

    // Above ₹500 threshold (₹1,000)
    $above = $service->validateCode('HENLEY-TESTREF-1', 1000.00);
    expect($above['valid'])->toBeTrue()
        ->and($above['discount_percent'])->toBe(10.0)
        ->and($above['discount_amount'])->toBe(100.00)
        ->and($above['referrer_credit_percent'])->toBe(20.0)
        ->and($above['referrer_credit_amount'])->toBe(200.00);
});

test('referral completion records transaction and credits 20% to referrer wallet', function (): void {
    $referrer = User::factory()->create([
        'name' => 'Sommelier Patron',
        'referral_code' => 'HENLEY-SOMMELIER',
        'wallet_balance' => 50.00,
    ]);

    $service = app(ReferralProgramService::class);

    // Referee places ₹2,000 order using code
    $referral = $service->recordReferralOrder('HENLEY-SOMMELIER', 2000.00, 9999);

    expect($referral)->toBeInstanceOf(CustomerReferral::class)
        ->and((float) $referral->discount_given)->toBe(200.00) // 10%
        ->and((float) $referral->store_credit_awarded)->toBe(400.00) // 20%
        ->and($referral->status)->toBe('completed');

    // Check referrer's wallet was credited by exactly 20% of ₹2,000 = ₹400
    $referrer->refresh();
    expect((float) $referrer->wallet_balance)->toBe(450.00); // 50 + 400

    // Check wallet transaction ledger
    $transaction = $referrer->walletTransactions()->latest('id')->first();
    expect($transaction)->not->toBeNull()
        ->and($transaction->type)->toBe('credit')
        ->and((float) $transaction->amount)->toBe(400.00)
        ->and((float) $transaction->balance_after)->toBe(450.00);
});
