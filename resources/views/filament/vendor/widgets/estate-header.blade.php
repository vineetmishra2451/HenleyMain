@php
    $vendor = $this->getVendor();
    $estateName = $vendor?->business_name ?? 'Artisanal Partner Estate';
    $legalName = $vendor?->legal_name ?? $estateName;
    $commissionRate = $vendor?->commission_rate ? number_format((float) $vendor->commission_rate, 1) . '%' : '15.0%';
    $location = is_array($vendor?->address) 
        ? implode(', ', array_filter([$vendor->address['city'] ?? null, $vendor->address['state'] ?? null, $vendor->address['country'] ?? null]))
        : 'Darjeeling, West Bengal, India';
    $email = $vendor?->email ?? auth()->user()?->email;
    $gstin = $vendor?->gstin ?? '19AAACH7409R1ZZ';
    $partnerId = 'VND-' . str_pad((string)($vendor?->id ?? 1), 3, '0', STR_PAD_LEFT);
@endphp

<x-filament-widgets::widget>
    <x-filament::section>
        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                        <x-filament::badge color="success" size="sm">
                            Verified Estate Partner
                        </x-filament::badge>
                        <x-filament::badge color="primary" size="sm">
                            {{ $commissionRate }} Contract Rate
                        </x-filament::badge>
                        <x-filament::badge color="gray" size="sm">
                            ID: {{ $partnerId }}
                        </x-filament::badge>
                    </div>

                    <h2 style="font-family: serif; font-size: 1.5rem; font-weight: 700; color: currentColor; letter-spacing: -0.02em; margin: 0;">
                        {{ $estateName }}
                    </h2>

                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 1.25rem; font-size: 0.8125rem; color: #9ca3af;">
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem;">
                            <x-heroicon-o-map-pin style="width: 15px; height: 15px; color: #6b7280; flex-shrink: 0;" />
                            {{ $location }}
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem;">
                            <x-heroicon-o-envelope style="width: 15px; height: 15px; color: #6b7280; flex-shrink: 0;" />
                            {{ $email }}
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-family: monospace;">
                            GSTIN: {{ $gstin }}
                        </span>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.75rem; align-self: flex-start;">
                    <x-filament::button
                        href="{{ url('/account') }}"
                        tag="a"
                        color="gray"
                        size="sm"
                        icon="heroicon-o-user-circle"
                    >
                        Estate Profile
                    </x-filament::button>

                    <x-filament::button
                        href="{{ url('/orders') }}"
                        tag="a"
                        color="primary"
                        size="sm"
                        icon="heroicon-o-shopping-bag"
                    >
                        Dispatch Queue
                    </x-filament::button>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
