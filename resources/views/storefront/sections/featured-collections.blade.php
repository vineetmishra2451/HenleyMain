@props([
    'payload' => [],
    'collections' => null,
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Terroir & Taxonomy';
$title = $payload['title'] ?? 'Curated Portals of Origin';
$description = $payload['description'] ?? 'Explore single-origin harvests grouped by mountain elevation, processing alchemy, and botanical character.';
$limit = (int) ($payload['limit'] ?? 4);

$items = $collections ?? \App\Models\Category::where('is_featured', true)->withCount('products')->take($limit)->get();
@endphp

@if ($items->isNotEmpty())
    <section class="w-full bg-surface-raised/40 py-16 sm:py-24 border-y border-hairline">
        <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 space-y-12">
            <x-section-heading
                :eyebrow="$eyebrow"
                :title="$title"
                :description="$description"
                align="center"
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($items as $cat)
                    <x-commerce.collection-card
                        :title="$cat->name"
                        :subtitle="$cat->parent?->name ?? 'Single Estate'"
                        :description="$cat->description"
                        :image="$cat->image_path ?? \App\Services\PlaceholderService::url('collection_tile', $cat->id)"
                        :href="'/collections/' . $cat->slug"
                        :arch-motif="true"
                    />
                @endforeach
            </div>

            <div class="text-center pt-4">
                <x-link-button href="/collections" variant="secondary" size="md" trailing-arrow>
                    View All {{ \App\Models\Category::count() }} Terroir Collections
                </x-link-button>
            </div>
        </div>
    </section>
@endif
