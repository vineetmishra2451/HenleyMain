@props([
    'variant' => 'hairline', // hairline | gold
    'ornament' => false, // diamond foil ornament in center
])

@if ($variant === 'gold')
    <div {{ $attributes->merge(['class' => 'relative my-8 flex items-center justify-center']) }} role="separator">
        <div class="w-full border-t border-gold/40"></div>
        @if ($ornament)
            <span class="absolute bg-canvas px-3 text-gold" aria-hidden="true">
                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                    <polygon points="12,2 22,12 12,22 2,12"/>
                </svg>
            </span>
        @endif
    </div>
@else
    <hr {{ $attributes->merge(['class' => 'my-8 border-0 border-t border-hairline']) }} role="separator">
@endif
