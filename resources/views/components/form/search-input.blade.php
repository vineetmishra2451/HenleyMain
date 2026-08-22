@props([
    'name' => 'search',
    'id' => null,
    'placeholder' => 'Search by harvest, single origin, or aromatic notes...',
    'value' => '',
])

@php
$inputId = $id ?? ($name ? $name : 'search_'.\Illuminate\Support\Str::random(8));
@endphp

<div x-data="{ query: '{{ addslashes((string) $value) }}' }" class="relative w-full">
    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-secondary" aria-hidden="true">
        <x-icons.search class="w-4 h-4" />
    </div>

    <input
        type="search"
        name="{{ $name }}"
        id="{{ $inputId }}"
        x-model="query"
        placeholder="{{ $placeholder }}"
        aria-label="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'block w-full rounded-full border border-hairline bg-surface-card pl-11 pr-10 py-3 text-ui text-primary placeholder:text-muted focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition-colors duration-250 ease-henley'
        ]) }}
    >

    <button
        type="button"
        x-show="query.length > 0"
        x-on:click="query = ''; $el.previousElementSibling.focus()"
        class="absolute inset-y-0 right-0 flex items-center pr-4 text-muted hover:text-primary transition-colors"
        aria-label="Clear search query"
        style="display: none;"
    >
        <x-icons.close class="w-4 h-4" />
    </button>
</div>
