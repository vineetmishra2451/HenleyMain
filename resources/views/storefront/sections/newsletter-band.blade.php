@props([
    'payload' => [],
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Private Allocation Dispatch';
$title = $payload['title'] ?? 'Join the Henley Collector Circle';
$description = $payload['description'] ?? 'Receive first notification when limited single-estate spring flushes and wild saffron reserves are bottled.';
@endphp

<section class="w-full bg-surface-raised py-20 border-t border-hairline relative overflow-hidden">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
        <div class="max-w-2xl mx-auto text-center space-y-4">
            <x-eyebrow variant="gold">
                {{ $eyebrow }}
            </x-eyebrow>

            <h2 class="font-serif text-display-2 font-normal text-primary tracking-tight">
                {{ $title }}
            </h2>

            <p class="text-body text-secondary max-w-lg mx-auto leading-relaxed">
                {{ $description }}
            </p>

            <div class="pt-4 max-w-md mx-auto">
                <livewire:storefront.newsletter-signup />
            </div>
        </div>
    </div>
</section>
