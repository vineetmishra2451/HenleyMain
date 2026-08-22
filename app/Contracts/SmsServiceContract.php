<?php

declare(strict_types=1);

namespace App\Contracts;

interface SmsServiceContract
{
    /**
     * Dispatch an OTP code or notification SMS to the specified recipient phone number.
     */
    public function sendOtp(string $phone, string $code): bool;
}
