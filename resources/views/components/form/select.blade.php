@props([
    'name' => '',
    'id' => null,
    'label' => null,
    'options' => [],
    'hint' => null,
    'error' => null,
    'required' => false,
    'placeholder' => null,
])

@php
$selectId = $id ?? ($name ? $name : 'select_'.\Illuminate\Support\Str::random(8));
$hasError = !empty($error);
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $selectId }}" class="block text-xs font-semibold uppercase tracking-[0.14em] text-primary">
            {{ $label }}
            @if ($required)
                <span class="text-accent ml-0.5" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <select
            name="{{ $name }}"
            id="{{ $selectId }}"
            @if ($required) required aria-required="true" @endif
            @if ($hasError)
                aria-invalid="true"
                aria-describedby="{{ $selectId }}-error"
            @elseif ($hint)
                aria-describedby="{{ $selectId }}-hint"
            @endif
            {{ $attributes->merge([
                'class' => 'block w-full appearance-none rounded-md border bg-surface-card px-4 py-2.5 pr-10 text-ui text-primary shadow-none focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition-colors duration-250 ease-henley ' .
                ($hasError ? 'border-saffron ring-1 ring-saffron' : 'border-hairline hover:border-muted')
            ]) }}
        >
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @foreach ($options as $val => $optLabel)
                <option value="{{ $val }}">{{ $optLabel }}</option>
            @endforeach

            {{ $slot }}
        </select>

        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-secondary" aria-hidden="true">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>

    @if ($hint && ! $hasError)
        <p id="{{ $selectId }}-hint" class="text-caption text-secondary">
            {{ $hint }}
        </p>
    @endif

    @if ($hasError)
        <p id="{{ $selectId }}-error" role="alert" class="text-caption text-saffron font-medium">
            {{ $error }}
        </p>
    @endif
</div>
