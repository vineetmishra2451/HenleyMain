@props([
    'name' => 'drawer',
    'side' => 'right', // right (cart) | left (mobile nav)
    'title' => null,
    'maxWidth' => 'md', // sm | md | lg
])

@php
$maxWidthClasses = match ($maxWidth) {
    'sm' => 'max-w-xs',
    'lg' => 'max-w-lg',
    default => 'max-w-md',
};

$placementClasses = $side === 'left' ? 'inset-y-0 left-0' : 'inset-y-0 right-0';
$enterStart = $side === 'left' ? '-translate-x-full' : 'translate-x-full';
$leaveEnd = $side === 'left' ? '-translate-x-full' : 'translate-x-full';
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
    x-on:open-drawer.window="if ($event.detail === '{{ $name }}') toggle()"
    x-on:close-drawer.window="if ($event.detail === '{{ $name }}') close()"
    x-on:keydown.escape.window="if (open) close()"
    class="relative z-50"
    role="dialog"
    aria-modal="true"
    @if ($title) aria-labelledby="{{ $name }}-title" @endif
    style="display: none;"
    x-show="open"
>
    <!-- Backdrop -->
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

    <!-- Drawer Panel -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed {{ $placementClasses }} flex max-w-full">
                <div
                    x-show="open"
                    x-transition:enter="transform transition ease-henley duration-400"
                    x-transition:enter-start="{{ $enterStart }}"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-henley duration-300"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="{{ $leaveEnd }}"
                    class="pointer-events-auto w-screen {{ $maxWidthClasses }} bg-surface-card shadow-2xl border-l border-hairline flex flex-col justify-between"
                >
                    <!-- Header -->
                    <div class="flex items-center justify-between p-6 border-b border-hairline">
                        @if ($title)
                            <h3 id="{{ $name }}-title" class="font-serif text-display-3 font-normal text-primary">
                                {{ $title }}
                            </h3>
                        @else
                            <div></div>
                        @endif

                        <button
                            type="button"
                            x-on:click="close()"
                            aria-label="Close drawer"
                            class="p-2 text-secondary hover:text-primary rounded-full hover:bg-surface-raised transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                        >
                            <x-icons.close class="w-4 h-4" />
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="flex-1 overflow-y-auto p-6">
                        {{ $slot }}
                    </div>

                    <!-- Optional Footer -->
                    @if (isset($footer))
                        <div class="p-6 border-t border-hairline bg-surface-raised/40">
                            {{ $footer }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
