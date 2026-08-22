<div
    x-data="{
        isOpen: @entangle('isOpen'),
        init() {
            window.addEventListener('keydown', (e) => {
                if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                    e.preventDefault();
                    this.isOpen = true;
                    $nextTick(() => $refs.searchInput.focus());
                }
                if (e.key === 'Escape' && this.isOpen) {
                    this.isOpen = false;
                    $wire.close();
                }
            });
        }
    }"
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 lg:p-20"
    role="dialog"
    aria-modal="true"
    aria-label="Catalogue Search"
    style="display: none;"
>
    <!-- Darkened Paper Backdrop -->
    <div
        class="fixed inset-0 bg-primary/50 backdrop-blur-md transition-opacity"
        x-on:click="isOpen = false; $wire.close()"
        aria-hidden="true"
    ></div>

    <!-- Search Modal Container -->
    <div class="relative mx-auto max-w-2xl rounded-2xl bg-surface-card border border-hairline shadow-2xl overflow-hidden transition-all">
        <!-- Search Input Bar -->
        <div class="relative flex items-center border-b border-hairline px-6 py-4">
            <x-icons.search class="w-5 h-5 text-secondary mr-3 flex-shrink-0" />

            <input
                x-ref="searchInput"
                wire:model.live.debounce.300ms="query"
                type="search"
                placeholder="Search single origin, harvest year, or aromatic notes..."
                class="w-full bg-transparent text-primary placeholder:text-muted text-base focus:outline-none border-none ring-0 focus:ring-0"
            >

            <button
                type="button"
                x-on:click="isOpen = false; $wire.close()"
                aria-label="Close search overlay"
                class="text-muted hover:text-primary p-1.5 rounded-full hover:bg-surface-raised transition ml-2"
            >
                <x-icons.close class="w-4 h-4" />
            </button>
        </div>

        <!-- Search Body -->
        <div class="p-6 max-h-[60vh] overflow-y-auto">
            @if (strlen(trim($query)) < 2)
                <!-- Empty State: Popular & Recent Searches -->
                <div class="space-y-6">
                    <div>
                        <span class="text-[10px] uppercase tracking-[0.18em] font-semibold text-secondary block mb-3">
                            Popular Ritual Inquiries
                        </span>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($popularSearches as $term)
                                <button
                                    type="button"
                                    wire:click="selectPopular('{{ $term }}')"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-surface-raised border border-hairline text-caption text-primary hover:border-accent hover:text-accent transition duration-200 select-none cursor-pointer"
                                >
                                    <x-icons.sparkles class="w-3 h-3 text-gold" />
                                    <span>{{ $term }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4 border-t border-hairline/60 flex items-center justify-between text-caption text-secondary">
                        <span>Press <kbd class="px-2 py-0.5 rounded bg-surface-raised border border-hairline text-[10px] font-mono text-primary">ESC</kbd> to exit</span>
                        <span>Full catalog search active</span>
                    </div>
                </div>
            @else
                <!-- Results State -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between text-caption text-secondary pb-2 border-b border-hairline/60">
                        <span>Showing matches for "<strong class="text-primary">{{ $query }}</strong>"</span>
                        <span>{{ count($results) }} results</span>
                    </div>

                    @if ($results->isNotEmpty())
                        <div class="divide-y divide-hairline">
                            @foreach ($results as $product)
                                <a
                                    href="/shop"
                                    class="flex items-center gap-4 py-3 group hover:bg-surface-raised/60 -mx-2 px-2 rounded-lg transition"
                                >
                                    <!-- Thumbnail -->
                                    <div class="w-12 h-12 rounded-md bg-surface-raised border border-hairline overflow-hidden flex-shrink-0 flex items-center justify-center">
                                        <x-icons.package class="w-6 h-6 text-muted" />
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-serif text-base text-primary group-hover:text-accent truncate transition-colors">
                                            {{ $product->name }}
                                        </h4>
                                        <p class="text-caption text-secondary truncate">
                                            {{ $product->subtitle ?? ($product->vendor->business_name ?? 'Henley Single-Origin') }}
                                        </p>
                                    </div>

                                    <!-- Price -->
                                    <div class="text-right flex-shrink-0">
                                        <x-commerce.price :price="$product->base_price" size="sm" />
                                        <span class="block text-[10px] text-sage font-medium">In Stock</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <!-- Zero Results -->
                        <div class="text-center py-8 space-y-2">
                            <x-icons.search class="w-8 h-8 text-muted mx-auto" />
                            <p class="text-body text-primary font-serif">No harvests found matching "{{ $query }}"</p>
                            <p class="text-caption text-secondary">Try searching for Darjeeling, Saffron, Cardamom, or Silver Needle.</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
