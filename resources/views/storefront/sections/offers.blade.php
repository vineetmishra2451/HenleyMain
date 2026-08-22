@props([
    'payload' => [],
])

@php
$activeCoupon = \App\Models\Coupon::active()->first();
$showOffer = $activeCoupon !== null || ! empty($payload['code']);
$code = $activeCoupon?->code ?? ($payload['code'] ?? 'RITUAL10');
$title = $payload['title'] ?? ($activeCoupon?->description ?? 'First Ritual Welcome Offering');
$description = $payload['description'] ?? 'Enjoy special privilege on your first single-origin harvest collection.';
$ctaLabel = $payload['cta_label'] ?? 'Claim Offering';
$ctaUrl = $payload['cta_url'] ?? '/collections';
@endphp

@if ($showOffer)
    <section class="w-full bg-surface-raised/80 py-10 border-y border-hairline my-6">
        <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 p-6 sm:p-8 rounded-2xl bg-surface-card border border-gold/40 shadow-subtle">
                <div class="flex items-center gap-4 text-center md:text-left">
                    <div class="hidden sm:flex h-12 w-12 items-center justify-center rounded-full bg-gold-surface border border-gold/30 text-gold-text flex-shrink-0">
                        <x-icons.sparkles class="w-6 h-6" />
                    </div>
                    <div class="space-y-1">
                        <div class="flex items-center gap-2 justify-center md:justify-start">
                            <span class="font-serif text-xl font-normal text-primary">{{ $title }}</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-gold-surface text-gold-text font-mono text-xs font-bold tracking-wider border border-gold/20">
                                {{ $code }}
                            </span>
                        </div>
                        <p class="text-caption text-secondary">{{ $description }}</p>
                    </div>
                </div>

                <div class="flex-shrink-0">
                    <x-link-button href="{{ $ctaUrl }}" variant="primary" size="md" trailing-arrow>
                        {{ $ctaLabel }}
                    </x-link-button>
                </div>
            </div>
        </div>
    </section>
@endif
