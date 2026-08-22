@props([
    'tabs' => [], // Array of ['id' => 'notes', 'label' => 'Tasting Notes']
    'default' => null,
])

@php
$defaultTab = $default ?? ($tabs[0]['id'] ?? '');
@endphp

<div
    x-data="{ activeTab: '{{ $defaultTab }}' }"
    {{ $attributes->merge(['class' => 'w-full space-y-8']) }}
>
    <!-- Tab Bar with active Oxblood bottom border -->
    <div class="border-b border-hairline flex items-center gap-8 overflow-x-auto no-scrollbar">
        @foreach ($tabs as $tab)
            <button
                type="button"
                x-on:click="activeTab = '{{ $tab['id'] }}'"
                :class="activeTab === '{{ $tab['id'] }}' ? 'border-accent text-accent font-semibold' : 'border-transparent text-secondary hover:text-primary hover:border-hairline font-normal'"
                class="pb-4 border-b-2 font-sans text-xs uppercase tracking-[0.16em] transition-all duration-250 ease-henley whitespace-nowrap cursor-pointer focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
            >
                {{ $tab['label'] }}
            </button>
        @endforeach
    </div>

    <!-- Tab Panels Container -->
    <div>
        {{ $slot }}
    </div>
</div>
