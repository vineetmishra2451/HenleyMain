@props([
    'tone' => 'info', // info | success | warning | error
    'title' => null,
    'dismissible' => false,
])

@php
$toneClasses = match ($tone) {
    'success' => 'bg-sage-surface border-sage/30 text-sage-text',
    'warning' => 'bg-gold-surface border-gold/40 text-gold-text',
    'error' => 'bg-error-surface border-error/30 text-error',
    default => 'bg-surface-raised border-hairline text-primary',
};

$iconComponent = match ($tone) {
    'success' => 'icons.check-circle',
    'warning' => 'icons.alert-circle',
    'error' => 'icons.alert-circle',
    default => 'icons.info',
};
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    role="alert"
    {{ $attributes->merge(['class' => "relative flex items-start gap-3.5 p-4 rounded-xl border {$toneClasses} transition-all duration-250 ease-henley"]) }}
>
    <div class="flex-shrink-0 mt-0.5" aria-hidden="true">
        <x-dynamic-component :component="$iconComponent" class="w-5 h-5" />
    </div>

    <div class="flex-1 space-y-1 text-ui">
        @if ($title)
            <h5 class="font-sans font-semibold tracking-wide text-xs uppercase">
                {{ $title }}
            </h5>
        @endif
        <div class="leading-relaxed">
            {{ $slot }}
        </div>
    </div>

    @if ($dismissible)
        <button
            type="button"
            x-on:click="show = false"
            aria-label="Dismiss alert"
            class="flex-shrink-0 -mr-1 -mt-1 p-1 rounded-md opacity-60 hover:opacity-100 hover:bg-black/5 transition duration-200"
        >
            <x-icons.close class="w-4 h-4" />
        </button>
    @endif
</div>
