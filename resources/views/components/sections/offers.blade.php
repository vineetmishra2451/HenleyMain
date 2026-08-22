@props([
    'coupons' => [],
    'banners' => [],
    'payload' => [],
])

@php
// Filter live active coupons
$activeOffers = collect($coupons)->filter(function ($coupon) {
    return $coupon->is_active &&
        ($coupon->starts_at === null || $coupon->starts_at->isPast()) &&
        ($coupon->expires_at === null || $coupon->expires_at->isFuture());
});
@endphp

@if ($activeOffers->isNotEmpty())
    <section class="w-full bg-surface-raised py-12 border-y border-gold/40">
        <x-container>
            <div class="p-8 rounded-2xl bg-gold-surface border border-gold/40 text-center space-y-4 max-w-4xl mx-auto shadow-sm">
                <x-eyebrow variant="gold">Seasonal Allocation Privilege</x-eyebrow>

                @foreach ($activeOffers->take(1) as $offer)
                    <h3 class="font-serif text-display-2 text-primary font-normal">
                        {{ $offer->description ?? 'Complimentary Brass Tasting Spoon on Orders Above ₹2,000' }}
                    </h3>

                    <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                        <span class="font-mono text-sm px-4 py-2 rounded-full border border-gold/60 bg-surface-card text-gold-text font-bold tracking-widest uppercase">
                            Use Code: {{ $offer->code }}
                        </span>

                        <x-link-button href="/shop" variant="primary" size="sm" trailing-arrow>
                            Redeem Privilege
                        </x-link-button>
                    </div>
                @endforeach
            </div>
        </x-container>
    </section>
@endif
