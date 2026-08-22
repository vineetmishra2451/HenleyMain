@props([
    'id' => null,
    'title' => '',
])

@php
$itemId = $id ?? 'acc_'.\Illuminate\Support\Str::random(8);
@endphp

<div class="py-4 select-none">
    <button
        type="button"
        x-on:click="toggle('{{ $itemId }}')"
        class="w-full flex items-center justify-between text-left py-2 font-serif text-display-3 text-primary hover:text-accent transition-colors duration-250 cursor-pointer focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
        :aria-expanded="isOpen('{{ $itemId }}')"
        aria-controls="{{ $itemId }}-content"
    >
        <span>{{ $title }}</span>

        <span class="ml-4 flex items-center text-secondary transition-transform duration-300" :class="{ 'rotate-180 text-accent': isOpen('{{ $itemId }}') }">
            <x-icons.chevron-down class="w-4 h-4" />
        </span>
    </button>

    <div
        id="{{ $itemId }}-content"
        x-show="isOpen('{{ $itemId }}')"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="pt-3 pb-2 text-body text-secondary"
        style="display: none;"
    >
        {{ $slot }}
    </div>
</div>
