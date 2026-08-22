<div
    x-data="{
        init() {
            this.$watch('$wire.isOpen', value => {
                if (value) {
                    this.$nextTick(() => this.$refs.searchInput?.focus());
                }
            });
        }
    }"
    x-on:keydown.escape.window="$wire.closeSearch()"
    x-show="$wire.isOpen"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto bg-primary/60 backdrop-blur-md p-4 sm:p-6 lg:p-8"
    role="dialog"
    aria-modal="true"
    aria-label="Catalogue Live Search"
    style="display: none;"
>
    <div class="mx-auto max-w-3xl pt-8 sm:pt-16">
        <div
            x-show="$wire.isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="overflow-hidden rounded-2xl border border-hairline bg-surface-card shadow-2xl"
        >
            <!-- Search Header Bar -->
            <div class="relative flex items-center border-b border-hairline px-6 py-4">
                <x-icons.search class="h-5 w-5 text-secondary mr-3" />

                <input
                    x-ref="searchInput"
                    type="search"
                    wire:model.live.debounce.250ms="query"
                    placeholder="Search by harvest, single-estate origin, or botanical profile..."
                    aria-label="Search catalogue"
                    class="w-full bg-transparent text-lg font-sans text-primary placeholder:text-muted focus:outline-none"
                >

                <div wire:loading wire:target="query" class="mr-3">
                    <x-spinner size="sm" color="accent" />
                </div>

                <button
                    type="button"
                    wire:click="closeSearch"
                    aria-label="Close search overlay"
                    class="rounded-full p-2 text-secondary hover:bg-surface-raised hover:text-primary transition"
                >
                    <x-icons.close class="h-4 w-4" />
                </button>
            </div>

            <!-- Search Body Content -->
            <div class="max-h-[65vh] overflow-y-auto p-6 space-y-6">
                @if (strlen(trim($query)) >= 2)
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-hairline mb-4">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold">
                                Search Results ({{ $results->count() }})
                            </span>
                            <span class="text-[11px] text-muted">Showing instant matches</span>
                        </div>

                        @if ($results->isNotEmpty())
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($results as $product)
                                    <a
                                        href="/products/{{ $product->slug }}"
                                        wire:click="closeSearch"
                                        class="flex items-center gap-3.5 p-3 rounded-xl border border-hairline bg-surface-raised/40 hover:border-accent hover:bg-surface-raised transition duration-200 group"
                                    >
                                        <div class="h-14 w-14 flex-shrink-0 overflow-hidden rounded-lg bg-surface-raised border border-hairline/60">
                                            @if ($product->primary_image)
                                                <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="flex h-full w-full items-center justify-center text-muted">
                                                    <x-icons.package class="h-6 w-6" />
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-serif text-sm font-medium text-primary group-hover:text-accent truncate transition-colors">
                                                {{ $product->name }}
                                            </h4>
                                            <p class="text-caption text-secondary truncate">
                                                {{ $product->subtitle ?? $product->primary_category?->name }}
                                            </p>
                                            <div class="mt-1">
                                                <x-commerce.price :price="$product->getPriceMoney()->formatted()" size="sm" />
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10 space-y-2">
                                <p class="font-serif text-lg text-primary">No botanical lots match “{{ $query }}”</p>
                                <p class="text-caption text-secondary">Try searching for “Darjeeling”, “Saffron”, or “White Tea”.</p>
                            </div>
                        @endif
                    </div>
                @else
                    <!-- Popular Search Suggestions & Categories -->
                    <div class="space-y-6">
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-3">
                                Popular Curations
                            </span>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($popularSearches as $term)
                                    <button
                                        type="button"
                                        wire:click="selectPopular('{{ $term }}')"
                                        class="px-3.5 py-1.5 rounded-full border border-hairline bg-surface-raised text-ui text-secondary hover:border-accent hover:text-accent hover:bg-surface-card transition duration-200"
                                    >
                                        {{ $term }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        @if ($featuredCategories->isNotEmpty())
                            <div class="pt-4 border-t border-hairline">
                                <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-3">
                                    Explore by Terroir
                                </span>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                    @foreach ($featuredCategories as $cat)
                                        <a
                                            href="/collections/{{ $cat->slug }}"
                                            wire:click="closeSearch"
                                            class="p-3 rounded-lg border border-hairline bg-surface-raised/40 text-center hover:border-accent hover:bg-surface-card transition group"
                                        >
                                            <span class="font-serif text-sm text-primary group-hover:text-accent block truncate">
                                                {{ $cat->name }}
                                            </span>
                                            <span class="text-[10px] uppercase tracking-wider text-muted block mt-0.5">
                                                Explore Collection →
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Footer Shortcut Help -->
            <div class="border-t border-hairline bg-surface-raised/40 px-6 py-3 flex items-center justify-between text-[11px] text-muted">
                <span>Press <kbd class="px-1.5 py-0.5 rounded bg-surface-card border border-hairline font-mono text-[10px]">ESC</kbd> to close</span>
                <span>Direct-to-estate verified catalogue</span>
            </div>
        </div>
    </div>
</div>
