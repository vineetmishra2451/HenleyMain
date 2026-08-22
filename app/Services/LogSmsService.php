<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\SmsServiceContract;
use Illuminate\Support\Facades\Log;

class LogSmsService implements SmsServiceContract
{
    /**
     * Send OTP code via structured system log (mock driver for testing/development).
     */
    public function sendOtp(string $phone, string $code): bool
    {
        Log::channel('single')->info('Henley Botanical OTP Dispatch', [
            'recipient' => $phone,
            'code' => $code,
            'message' => "Your Henley authentication code is {$code}. Valid for 5 minutes.",
            'timestamp' => now()->toIso8601String(),
        ]);

        return true;
    }
}
