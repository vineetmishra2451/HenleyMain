@props([
    'name' => '',
    'value' => '',
    'id' => null,
    'title' => '',
    'subtitle' => null,
    'price' => null,
    'checked' => false,
    'badge' => null,
])

@php
$radioId = $id ?? ($name.'_'.\Illuminate\Support\Str::slug((string) $value));
@endphp

<label for="{{ $radioId }}" class="relative flex items-center justify-between p-4 rounded-lg border border-hairline bg-surface-card hover:border-muted hover:bg-surface-raised/40 transition-all duration-250 ease-henley cursor-pointer select-none group has-[:checked]:border-accent has-[:checked]:bg-surface-raised has-[:checked]:ring-1 has-[:checked]:ring-accent">
    <div class="flex items-center gap-3.5">
        <input
            type="radio"
            name="{{ $name }}"
            value="{{ $value }}"
            id="{{ $radioId }}"
            @if ($checked) checked @endif
            {{ $attributes->merge(['class' => 'h-4 w-4 border-hairline text-accent focus:ring-accent focus:ring-offset-0 cursor-pointer']) }}
        >

        <div>
            <div class="flex items-center gap-2">
                <span class="text-ui font-medium text-primary">{{ $title }}</span>
                @if ($badge)
                    <span class="px-2 py-0.5 text-[10px] uppercase tracking-wider font-bold rounded-full bg-gold-surface text-gold-text">
                        {{ $badge }}
                    </span>
                @endif
            </div>
            @if ($subtitle)
                <p class="text-caption text-secondary mt-0.5">{{ $subtitle }}</p>
            @endif
        </div>
    </div>

    @if ($price)
        <div class="font-serif text-lg font-medium text-primary tracking-tight">
            {{ $price }}
        </div>
    @endif
</label>
