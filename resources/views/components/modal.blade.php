@props([
    'name' => 'modal',
    'title' => null,
    'maxWidth' => 'md', // sm | md | lg | xl
])

@php
$maxWidthClasses = match ($maxWidth) {
    'sm' => 'sm:max-w-sm',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-2xl',
    default => 'sm:max-w-md',
};
@endphp

<div
    x-data="{
        open: false,
        lastFocused: null,
        toggle() {
            if (this.open) {
                this.close();
            } else {
                this.lastFocused = document.activeElement;
                this.open = true;
                $nextTick(() => {
                    let focusable = $el.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex=\'-1\'])');
                    if (focusable) focusable.focus();
                });
            }
        },
        close() {
            this.open = false;
            if (this.lastFocused) {
                this.lastFocused.focus();
            }
        }
    }"
    x-on:open-modal.window="if ($event.detail === '{{ $name }}') toggle()"
    x-on:close-modal.window="if ($event.detail === '{{ $name }}') close()"
    x-on:keydown.escape.window="if (open) close()"
    class="relative z-50"
    role="dialog"
    aria-modal="true"
    @if ($title) aria-labelledby="{{ $name }}-title" @endif
    style="display: none;"
    x-show="open"
>
    <!-- Backdrop with soft paper blur -->
    <div
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-primary/40 backdrop-blur-sm transition-opacity"
        x-on:click="close()"
        aria-hidden="true"
    ></div>

    <!-- Dialog container -->
    <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 lg:p-8 flex items-center justify-center">
        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full {{ $maxWidthClasses }} rounded-2xl bg-surface-card p-6 sm:p-8 border border-hairline shadow-2xl transition-all"
        >
            <!-- Close Button -->
            <button
                type="button"
                x-on:click="close()"
                aria-label="Close dialog"
                class="absolute top-4 right-4 p-2 text-secondary hover:text-primary rounded-full hover:bg-surface-raised transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
            >
                <x-icons.close class="w-4 h-4" />
            </button>

            @if ($title)
                <h3 id="{{ $name }}-title" class="font-serif text-display-3 font-normal text-primary mb-4 pr-8">
                    {{ $title }}
                </h3>
            @endif

            <div class="text-body text-primary">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
