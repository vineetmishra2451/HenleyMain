@props([
    'payload' => [],
    'posts' => null,
])

@php
$eyebrow = $payload['eyebrow'] ?? 'The Botanical Journal';
$title = $payload['title'] ?? 'Field Notes & Brewing Alchemy';
$description = $payload['description'] ?? 'Essays on high-altitude terroir, aromatic chemistry, and the unhurried ritual of tea extraction.';
$limit = (int) ($payload['limit'] ?? 3);

$items = $posts ?? \App\Models\JournalPost::where('is_published', true)
    ->latest('published_at')
    ->take($limit)
    ->get();
@endphp

@if ($items->isNotEmpty())
    <section class="w-full bg-canvas py-16 sm:py-24 overflow-hidden">
        <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 space-y-12">
            <x-section-heading
                :eyebrow="$eyebrow"
                :title="$title"
                :description="$description"
                align="center"
            />

            <div class="flex items-center justify-between md:hidden -mt-6 mb-1">
                <span class="text-caption text-secondary/70">Swipe field notes →</span>
            </div>

            <!-- Mobile Horizontal Swipe Scroller & Desktop Grid -->
            <div class="flex overflow-x-auto no-scrollbar snap-x snap-mandatory gap-5 pb-4 -mx-5 px-5 sm:mx-0 sm:px-0 md:grid md:grid-cols-3 md:gap-8 md:overflow-visible md:pb-0">
                @foreach ($items as $post)
                    <article class="group flex flex-col justify-between rounded-2xl border border-hairline bg-surface-raised/40 overflow-hidden hover:border-muted hover:shadow-hover transition-all duration-350 w-[285px] sm:w-[320px] md:w-auto flex-shrink-0 snap-start">
                        <div>
                            <!-- Cover Image -->
                            <div class="aspect-[16/10] w-full overflow-hidden bg-surface-raised">
                                <img
                                    src="{{ $post->cover_image ? '/' . ltrim($post->cover_image, '/') : \App\Services\PlaceholderService::url('journal_cover', $post->id) }}"
                                    alt="{{ $post->title }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                >
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-3">
                                <div class="flex items-center justify-between text-caption text-secondary">
                                    <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recent Dispatch' }}</span>
                                    <span>{{ $post->reading_time_minutes }} min read</span>
                                </div>

                                <h3 class="font-serif text-xl font-normal text-primary group-hover:text-accent transition-colors leading-snug">
                                    <a href="/journal/{{ $post->slug }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-body text-secondary line-clamp-2 leading-relaxed">
                                    {{ $post->excerpt }}
                                </p>
                            </div>
                        </div>

                        <div class="px-6 pb-6 pt-2">
                            <a href="/journal/{{ $post->slug }}" class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-accent group-hover:text-accent-hover inline-flex items-center gap-1.5">
                                <span>Read Essay</span>
                                <span class="inline-block transition-transform duration-250 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center pt-4">
                <x-link-button href="/journal" variant="secondary" size="md" trailing-arrow>
                    Read The Complete Botanical Journal
                </x-link-button>
            </div>
        </div>
    </section>
@endif
