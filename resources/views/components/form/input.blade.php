@props([
    'name' => '',
    'id' => null,
    'label' => null,
    'type' => 'text',
    'hint' => null,
    'error' => null,
    'required' => false,
    'placeholder' => null,
])

@php
$inputId = $id ?? ($name ? $name : 'input_'.\Illuminate\Support\Str::random(8));
$hasError = !empty($error);
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $inputId }}" class="block text-xs font-semibold uppercase tracking-[0.14em] text-primary">
            {{ $label }}
            @if ($required)
                <span class="text-accent ml-0.5" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $inputId }}"
            placeholder="{{ $placeholder }}"
            @if ($required) required aria-required="true" @endif
            @if ($hasError)
                aria-invalid="true"
                aria-describedby="{{ $inputId }}-error"
            @elseif ($hint)
                aria-describedby="{{ $inputId }}-hint"
            @endif
            {{ $attributes->merge([
                'class' => 'block w-full rounded-md border bg-surface-card px-4 py-2.5 text-ui text-primary shadow-none placeholder:text-muted focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition-colors duration-250 ease-henley ' .
                ($hasError ? 'border-saffron ring-1 ring-saffron bg-saffron-surface/20' : 'border-hairline hover:border-muted')
            ]) }}
        >
    </div>

    @if ($hint && ! $hasError)
        <p id="{{ $inputId }}-hint" class="text-caption text-secondary">
            {{ $hint }}
        </p>
    @endif

    @if ($hasError)
        <p id="{{ $inputId }}-error" role="alert" class="text-caption text-saffron font-medium">
            {{ $error }}
        </p>
    @endif
</div>
