@props([
    'name' => '',
    'value' => '',
    'id' => null,
    'label' => null,
    'hint' => null,
    'error' => null,
    'checked' => false,
])

@php
$radioId = $id ?? ($name.'_'.\Illuminate\Support\Str::slug((string) $value));
$hasError = !empty($error);
@endphp

<div class="space-y-1">
    <label for="{{ $radioId }}" class="flex items-start gap-3 cursor-pointer group select-none">
        <input
            type="radio"
            name="{{ $name }}"
            value="{{ $value }}"
            id="{{ $radioId }}"
            @if ($checked) checked @endif
            {{ $attributes->merge([
                'class' => 'mt-0.5 h-4 w-4 border-hairline bg-surface-card text-accent focus:ring-accent focus:ring-offset-0 transition duration-250 ease-henley cursor-pointer ' .
                ($hasError ? 'border-saffron' : 'group-hover:border-accent')
            ]) }}
        >

        @if ($label || $slot->isNotEmpty())
            <div class="text-ui text-primary leading-tight">
                {{ $label ?? $slot }}
                @if ($hint)
                    <p class="text-caption text-secondary mt-0.5 font-normal">{{ $hint }}</p>
                @endif
            </div>
        @endif
    </label>

    @if ($hasError)
        <p role="alert" class="text-caption text-saffron font-medium ml-7">
            {{ $error }}
        </p>
    @endif
</div>
