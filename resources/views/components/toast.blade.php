@props([
    'tone' => 'success', // success | info | error
    'message' => 'Your ritual basket has been updated.',
    'duration' => 4000,
])

<div
    x-data="{ visible: true }"
    x-init="setTimeout(() => visible = false, {{ (int) $duration }})"
    x-show="visible"
    x-transition:enter="transition ease-henley duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave="transition ease-henley duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    role="status"
    aria-live="polite"
    {{ $attributes->merge(['class' => 'fixed bottom-6 right-6 z-50 flex items-center gap-3 rounded-full border border-hairline bg-surface-card px-5 py-3 shadow-card-hover']) }}
>
    @if ($tone === 'success')
        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-sage-surface text-sage-text">
            <x-icons.check class="h-3.5 w-3.5" />
        </span>
    @elseif ($tone === 'error')
        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-error-surface text-error">
            <x-icons.close class="h-3.5 w-3.5" />
        </span>
    @else
        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-gold-surface text-gold-text">
            <x-icons.sparkles class="h-3.5 w-3.5" />
        </span>
    @endif

    <span class="font-sans text-ui font-medium text-primary">
        {{ $message ?? $slot }}
    </span>

    <button
        type="button"
        x-on:click="visible = false"
        aria-label="Close notification"
        class="ml-2 text-muted hover:text-primary transition-colors"
    >
        <x-icons.close class="h-3.5 w-3.5" />
    </button>
</div>
