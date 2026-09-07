@php
    $vendor = $this->getVendor();
    $address = is_array($vendor?->address) ? $vendor->address : [];
    $bank = is_array($vendor?->bank_details) ? $vendor->bank_details : [];
@endphp

<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.75rem; max-width: 64rem;">
        <!-- Estate Header Banner Card -->
        <x-filament::section>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <!-- Avatar Placeholder -->
                        <div style="width: 56px; height: 56px; border-radius: 9999px; background: #4B1421; color: #ffffff; display: flex; align-items: center; justify-content: center; font-family: serif; font-size: 1.5rem; font-weight: 700; border: 2px solid rgba(75, 20, 33, 0.2); flex-shrink: 0;">
                            {{ strtoupper(substr($vendor?->business_name ?? 'H', 0, 2)) }}
                        </div>
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                                <x-filament::badge color="success" size="sm">
                                    {{ strtoupper($vendor?->status?->value ?? 'ACTIVE') }}
                                </x-filament::badge>
                                <span style="font-family: monospace; font-size: 0.75rem; color: #9ca3af;">
                                    VND-{{ str_pad((string)($vendor?->id ?? 1), 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                            <h2 style="font-family: serif; font-size: 1.5rem; font-weight: 700; color: currentColor; margin: 0;">
                                {{ $vendor?->business_name ?? 'Darjeeling Himalayan Tea Estate' }}
                            </h2>
                            <p style="font-size: 0.8125rem; color: #9ca3af; margin-top: 0.15rem;">
                                Legal Name: <span style="font-weight: 500; color: currentColor;">{{ $vendor?->legal_name ?? 'Himalayan High Gardens Private Ltd' }}</span>
                            </p>
                        </div>
                    </div>

                    <div style="text-align: right;">
                        <span style="font-size: 0.75rem; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; display: block;">Contract Commission</span>
                        <span style="font-family: serif; font-size: 1.5rem; font-weight: 700; color: #4B1421;">
                            {{ number_format((float) ($vendor?->commission_rate ?? 15.0), 1) }}%
                        </span>
                    </div>
                </div>
            </div>
        </x-filament::section>

        <!-- 1. Vendor Profile Section -->
        <x-filament::section>
            <x-slot name="heading">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <x-heroicon-o-user style="width: 18px; height: 18px; color: #6b7280; flex-shrink: 0;" />
                    <span>Vendor Profile & Contact Person</span>
                </div>
            </x-slot>

            <x-slot name="description">
                Personal credentials and contact information for your authorized estate manager.
            </x-slot>

            <form wire:submit.prevent="saveProfile" style="display: flex; flex-direction: column; gap: 1rem; margin-top: 0.5rem;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Representative Name</label>
                        <input
                            type="text"
                            wire:model="name"
                            style="width: 100%; border-radius: 0.5rem; border: 1px solid rgba(156, 163, 175, 0.3); background: transparent; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: currentColor;"
                        />
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Official Contact Email</label>
                        <input
                            type="email"
                            wire:model="email"
                            style="width: 100%; border-radius: 0.5rem; border: 1px solid rgba(156, 163, 175, 0.3); background: transparent; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: currentColor;"
                        />
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Concierge Phone</label>
                        <input
                            type="text"
                            wire:model="phone"
                            style="width: 100%; border-radius: 0.5rem; border: 1px solid rgba(156, 163, 175, 0.3); background: transparent; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: currentColor;"
                        />
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; margin-top: 0.5rem;">
                    <x-filament::button type="submit" color="primary" size="sm">
                        Save Profile
                    </x-filament::button>
                </div>
            </form>
        </x-filament::section>

        <!-- 2. Business Details (Masked Payouts) Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
            <!-- Terroir & Operations -->
            <x-filament::section>
                <x-slot name="heading">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <x-heroicon-o-map-pin style="width: 18px; height: 18px; color: #6b7280; flex-shrink: 0;" />
                        <span>Estate Terroir & Operations</span>
                    </div>
                </x-slot>

                <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.875rem;">
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(156, 163, 175, 0.15); padding-bottom: 0.5rem;">
                        <span style="color: #9ca3af;">Registered Business</span>
                        <span style="font-weight: 500; color: currentColor;">{{ $vendor?->business_name }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(156, 163, 175, 0.15); padding-bottom: 0.5rem;">
                        <span style="color: #9ca3af;">Location</span>
                        <span style="font-weight: 500; color: currentColor; text-align: right;">
                            {{ $address['city'] ?? 'Darjeeling' }}, {{ $address['state'] ?? 'West Bengal' }}, {{ $address['country'] ?? 'India' }}
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #9ca3af;">Postal Code</span>
                        <span style="font-family: monospace; color: currentColor;">{{ $address['postal_code'] ?? '734101' }}</span>
                    </div>
                </div>
            </x-filament::section>

            <!-- Tax & Bank Settlement (Masked) -->
            <x-filament::section>
                <x-slot name="heading">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <x-heroicon-o-banknotes style="width: 18px; height: 18px; color: #6b7280; flex-shrink: 0;" />
                        <span>Tax & Bank Disbursements</span>
                    </div>
                </x-slot>

                <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.875rem;">
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(156, 163, 175, 0.15); padding-bottom: 0.5rem;">
                        <span style="color: #9ca3af;">GSTIN / Tax ID</span>
                        <span style="font-family: monospace; font-weight: 500; color: currentColor;">{{ $vendor?->gstin ?? '19AAACH7409R1ZZ' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(156, 163, 175, 0.15); padding-bottom: 0.5rem;">
                        <span style="color: #9ca3af;">Bank Name</span>
                        <span style="font-weight: 500; color: currentColor;">{{ $bank['bank_name'] ?? 'State Bank of India' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(156, 163, 175, 0.15); padding-bottom: 0.5rem;">
                        <span style="color: #9ca3af;">Account Beneficiary</span>
                        <span style="font-weight: 500; color: currentColor;">{{ $bank['account_name'] ?? ($vendor?->legal_name ?? $vendor?->business_name) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(156, 163, 175, 0.15); padding-bottom: 0.5rem;">
                        <span style="color: #9ca3af;">Account Number</span>
                        <span style="font-family: monospace; color: currentColor;">••••••••4819</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #9ca3af;">IFSC Routing Code</span>
                        <span style="font-family: monospace; color: currentColor;">{{ $bank['ifsc'] ?? 'SBIN0000063' }}</span>
                    </div>
                </div>
            </x-filament::section>
        </div>

        <!-- 3. Settings: Notification Preferences & Password Change -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
            <!-- Notification Preferences -->
            <x-filament::section>
                <x-slot name="heading">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <x-heroicon-o-bell style="width: 18px; height: 18px; color: #6b7280; flex-shrink: 0;" />
                        <span>Notification Preferences</span>
                    </div>
                </x-slot>

                <div style="display: flex; flex-direction: column; gap: 1rem; font-size: 0.875rem;">
                    <label style="display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                        <div>
                            <span style="font-weight: 500; display: block;">Order Dispatch Alerts</span>
                            <span style="font-size: 0.75rem; color: #9ca3af;">Instant notification upon customer reserve allocation.</span>
                        </div>
                        <input type="checkbox" wire:model="notifyNewOrders" style="accent-color: #4B1421; width: 18px; height: 18px;" />
                    </label>

                    <label style="display: flex; align-items: center; justify-content: space-between; cursor: pointer; border-top: 1px solid rgba(156, 163, 175, 0.15); padding-top: 0.75rem;">
                        <div>
                            <span style="font-weight: 500; display: block;">Low Stock Warnings</span>
                            <span style="font-size: 0.75rem; color: #9ca3af;">Trigger warnings when variants reach reorder thresholds.</span>
                        </div>
                        <input type="checkbox" wire:model="notifyLowStock" style="accent-color: #4B1421; width: 18px; height: 18px;" />
                    </label>

                    <label style="display: flex; align-items: center; justify-content: space-between; cursor: pointer; border-top: 1px solid rgba(156, 163, 175, 0.15); padding-top: 0.75rem;">
                        <div>
                            <span style="font-weight: 500; display: block;">Settlement Payout Confirmations</span>
                            <span style="font-size: 0.75rem; color: #9ca3af;">Bi-weekly disbursement NEFT/RTGS transaction receipts.</span>
                        </div>
                        <input type="checkbox" wire:model="notifyPayoutDisbursements" style="accent-color: #4B1421; width: 18px; height: 18px;" />
                    </label>

                    <div style="display: flex; justify-content: flex-end; margin-top: 0.5rem;">
                        <x-filament::button wire:click="saveNotificationSettings" color="gray" size="sm">
                            Save Preferences
                        </x-filament::button>
                    </div>
                </div>
            </x-filament::section>

            <!-- Password Change -->
            <x-filament::section>
                <x-slot name="heading">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <x-heroicon-o-lock-closed style="width: 18px; height: 18px; color: #6b7280; flex-shrink: 0;" />
                        <span>Security & Password</span>
                    </div>
                </x-slot>

                <form wire:submit.prevent="updatePassword" style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Current Password</label>
                        <input
                            type="password"
                            wire:model="currentPassword"
                            style="width: 100%; border-radius: 0.5rem; border: 1px solid rgba(156, 163, 175, 0.3); background: transparent; padding: 0.4rem 0.6rem; font-size: 0.875rem; color: currentColor;"
                        />
                        @error('currentPassword') <span style="font-size: 0.75rem; color: #f43f5e;">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">New Password</label>
                        <input
                            type="password"
                            wire:model="newPassword"
                            style="width: 100%; border-radius: 0.5rem; border: 1px solid rgba(156, 163, 175, 0.3); background: transparent; padding: 0.4rem 0.6rem; font-size: 0.875rem; color: currentColor;"
                        />
                        @error('newPassword') <span style="font-size: 0.75rem; color: #f43f5e;">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Confirm New Password</label>
                        <input
                            type="password"
                            wire:model="newPasswordConfirmation"
                            style="width: 100%; border-radius: 0.5rem; border: 1px solid rgba(156, 163, 175, 0.3); background: transparent; padding: 0.4rem 0.6rem; font-size: 0.875rem; color: currentColor;"
                        />
                    </div>

                    <div style="display: flex; justify-content: flex-end; margin-top: 0.5rem;">
                        <x-filament::button type="submit" color="primary" size="sm">
                            Update Password
                        </x-filament::button>
                    </div>
                </form>
            </x-filament::section>
        </div>

        <!-- 4. Session & Logout -->
        <x-filament::section>
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h3 style="font-size: 0.9375rem; font-weight: 600; color: currentColor; margin: 0;">Cellar Session Management</h3>
                    <p style="font-size: 0.8125rem; color: #9ca3af; margin: 0.25rem 0 0 0;">
                        Securely terminate the active estate cellar session and return to partner authentication portal.
                    </p>
                </div>

                <x-filament::button
                    wire:click="logout"
                    color="danger"
                    size="sm"
                    icon="heroicon-o-arrow-right-on-rectangle"
                >
                    Sign Out of Cellar Panel
                </x-filament::button>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
