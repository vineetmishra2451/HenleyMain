<?php

declare(strict_types=1);

namespace App\Contracts;

interface TwoFactorAuthenticatable
{
    /**
     * Determine if two-factor authentication is enabled and confirmed for this user.
     */
    public function hasEnabledTwoFactorAuthentication(): bool;

    /**
     * Get the two-factor authentication secret key.
     */
    public function getTwoFactorSecret(): ?string;

    /**
     * Get the recovery codes for two-factor authentication.
     *
     * @return list<string>
     */
    public function getTwoFactorRecoveryCodes(): array;
}
