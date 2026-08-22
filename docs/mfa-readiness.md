# Multi-Factor Authentication (MFA) Readiness Architecture

Henley is pre-architected for Multi-Factor Authentication (TOTP Authenticator Apps) across all administrative, vendor, and customer surfaces.

---

## 1. Schema Specifications

The `users` table contains the following columns for MFA:
- `two_factor_secret` (`text`, nullable): Encrypted Base32 TOTP secret key generated for standard authenticator applications (Google Authenticator, 1Password, Authy).
- `two_factor_recovery_codes` (`text`, nullable): JSON-encoded hashed recovery emergency one-time codes.
- `two_factor_confirmed_at` (`timestampTz`, nullable): Timestamp indicating when the user verified their initial TOTP token to confirm enablement.

---

## 2. Contracts & Model Traits

- **Interface**: `App\Contracts\TwoFactorAuthenticatable`
  - `hasEnabledTwoFactorAuthentication(): bool`
  - `getTwoFactorSecret(): ?string`
  - `getTwoFactorRecoveryCodes(): array`
- **Trait**: `App\Models\Concerns\HasTwoFactorAuthentication`
  - Implemented on `App\Models\User`.

---

## 3. Enablement Path (Activation Guide)

When MFA enrollment is enabled in production:
1. **Secret Generation**:
   ```php
   $google2fa = new \PragmaRX\Google2FA\Google2FA();
   $secret = $google2fa->generateSecretKey();
   $user->update(['two_factor_secret' => encrypt($secret)]);
   ```
2. **QR Code Rendering**:
   ```php
   $qrCodeUrl = $google2fa->getQRCodeUrl(
       config('henley.brand.name'),
       $user->email,
       decrypt($user->two_factor_secret)
   );
   ```
3. **Confirmation & Recovery Codes**:
   ```php
   if ($google2fa->verifyKey(decrypt($user->two_factor_secret), $submittedCode)) {
       $recoveryCodes = collect(range(1, 8))->map(fn () => Str::random(10) . '-' . Str::random(10));
       $user->update([
           'two_factor_recovery_codes' => json_encode($recoveryCodes->all()),
           'two_factor_confirmed_at' => now(),
       ]);
   }
   ```
4. **Filament Integration**:
   Add `->requiresTwoFactorAuthentication()` to `AdminPanelProvider` and `VendorPanelProvider`.
