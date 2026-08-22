@props([
    'name' => 'quantity',
    'value' => 1,
    'min' => 1,
    'max' => 99,
])

<div
    x-data="{ count: {{ (int) $value }}, min: {{ (int) $min }}, max: {{ (int) $max }} }"
    class="inline-flex items-center rounded-full border border-hairline bg-surface-card p-1 shadow-none"
>
    <button
        type="button"
        x-on:click="if (count > min) count--"
        :disabled="count <= min"
        aria-label="Decrease quantity"
        class="flex h-8 w-8 items-center justify-center rounded-full text-secondary hover:text-accent hover:bg-surface-raised disabled:opacity-30 disabled:cursor-not-allowed transition duration-250 ease-henley focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
    >
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
        </svg>
    </button>

    <input
        type="number"
        name="{{ $name }}"
        x-model="count"
        min="{{ $min }}"
        max="{{ $max }}"
        readonly
        aria-label="Quantity"
        class="w-10 bg-transparent text-center font-sans text-ui font-semibold text-primary focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
        {{ $attributes }}
    >

    <button
        type="button"
        x-on:click="if (count < max) count++"
        :disabled="count >= max"
        aria-label="Increase quantity"
        class="flex h-8 w-8 items-center justify-center rounded-full text-secondary hover:text-accent hover:bg-surface-raised disabled:opacity-30 disabled:cursor-not-allowed transition duration-250 ease-henley focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
    >
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
    </button>
</div>
