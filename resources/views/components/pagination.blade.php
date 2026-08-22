@props([
    'currentPage' => 1,
    'totalPages' => 1,
    'baseUrl' => '?page=',
])

@php
$prevUrl = $currentPage > 1 ? $baseUrl.($currentPage - 1) : null;
$nextUrl = $currentPage < $totalPages ? $baseUrl.($currentPage + 1) : null;
@endphp

<nav aria-label="Pagination" {{ $attributes->merge(['class' => 'flex items-center justify-between border-t border-hairline pt-6 px-4']) }}>
    <div class="flex flex-1 justify-between sm:hidden">
        @if ($prevUrl)
            <a href="{{ $prevUrl }}" class="px-4 py-2 border border-hairline rounded-full text-caption uppercase tracking-wider font-medium text-primary hover:border-accent hover:text-accent">
                Previous
            </a>
        @else
            <span class="px-4 py-2 border border-hairline/40 rounded-full text-caption uppercase tracking-wider font-medium text-muted cursor-not-allowed">
                Previous
            </span>
        @endif

        @if ($nextUrl)
            <a href="{{ $nextUrl }}" class="px-4 py-2 border border-hairline rounded-full text-caption uppercase tracking-wider font-medium text-primary hover:border-accent hover:text-accent">
                Next
            </a>
        @else
            <span class="px-4 py-2 border border-hairline/40 rounded-full text-caption uppercase tracking-wider font-medium text-muted cursor-not-allowed">
                Next
            </span>
        @endif
    </div>

    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <p class="text-caption text-secondary">
            Showing Page <span class="font-medium text-primary">{{ $currentPage }}</span> of <span class="font-medium text-primary">{{ $totalPages }}</span>
        </p>

        <div class="flex items-center space-x-1.5">
            @if ($prevUrl)
                <a href="{{ $prevUrl }}" aria-label="Previous page" class="p-2 rounded-full border border-hairline text-secondary hover:border-accent hover:text-accent hover:bg-surface-raised transition">
                    <x-icons.chevron-right class="w-4 h-4 rotate-180" />
                </a>
            @else
                <span class="p-2 rounded-full border border-hairline/40 text-muted cursor-not-allowed">
                    <x-icons.chevron-right class="w-4 h-4 rotate-180" />
                </span>
            @endif

            @for ($p = 1; $p <= $totalPages; $p++)
                @if ($p == $currentPage)
                    <span aria-current="page" class="w-9 h-9 flex items-center justify-center rounded-full bg-accent text-inverse font-sans text-xs font-semibold select-none">
                        {{ $p }}
                    </span>
                @else
                    <a href="{{ $baseUrl.$p }}" class="w-9 h-9 flex items-center justify-center rounded-full border border-hairline text-primary hover:border-accent hover:text-accent hover:bg-surface-raised transition font-sans text-xs font-medium">
                        {{ $p }}
                    </a>
                @endif
            @endfor

            @if ($nextUrl)
                <a href="{{ $nextUrl }}" aria-label="Next page" class="p-2 rounded-full border border-hairline text-secondary hover:border-accent hover:text-accent hover:bg-surface-raised transition">
                    <x-icons.chevron-right class="w-4 h-4" />
                </a>
            @else
                <span class="p-2 rounded-full border border-hairline/40 text-muted cursor-not-allowed">
                    <x-icons.chevron-right class="w-4 h-4" />
                </span>
            @endif
        </div>
    </div>
</nav>
