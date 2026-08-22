@props([
    'posts' => [],
    'payload' => [],
])

@php
$title = $payload['title'] ?? 'The Botanical Journal';
$eyebrow = $payload['eyebrow'] ?? 'Field Notes & Extraction Science';
$description = $payload['description'] ?? 'Essays on high-altitude terroir, aromatic chemistry, and the unhurried rituals of master growers.';
@endphp

<section class="w-full bg-surface-raised py-20 sm:py-24 border-t border-hairline">
    <x-container>
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 sm:mb-16 gap-6">
            <x-section-heading
                :eyebrow="$eyebrow"
                :title="$title"
                :description="$description"
                align="left"
                class="mb-0"
            />

            <a href="/journal" class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-accent hover:text-accent-hover inline-flex items-center gap-1.5 self-start md:self-end flex-shrink-0 group">
                <span>View All Articles</span>
                <span class="inline-block transition-transform duration-250 ease-henley group-hover:translate-x-1">→</span>
            </a>
        </div>

        @if (! empty($posts) && count($posts) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <article class="group flex flex-col justify-between space-y-4 rounded-xl p-4 bg-surface-card border border-hairline hover:border-muted hover:shadow-hover transition duration-300">
                        <div class="space-y-4">
                            <!-- Article Cover -->
                            <div class="aspect-[16/10] w-full rounded-lg overflow-hidden bg-surface-raised relative">
                                <img
                                    src="/images/brand/collectionpage.jpeg"
                                    alt="{{ $post->title }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover object-center transition-transform duration-500 ease-henley group-hover:scale-105"
                                >
                            </div>

                            <div class="flex items-center gap-3 text-caption text-secondary">
                                <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : date('M d, Y') }}</span>
                                <span class="text-hairline" aria-hidden="true">•</span>
                                <span>{{ $post->reading_time_minutes ?? 5 }} min read</span>
                            </div>

                            <h3 class="font-serif text-display-3 font-normal text-primary group-hover:text-accent transition-colors line-clamp-2">
                                <a href="/journal" class="focus:outline-none">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <p class="text-body text-secondary line-clamp-2">
                                {{ $post->excerpt }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-hairline/60 flex items-center justify-between">
                            <span class="text-caption text-secondary font-medium">By {{ $post->author_name }}</span>
                            <span class="text-accent text-sm font-semibold group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- Graceful Empty State -->
            <x-empty-state
                title="Journal entries being inked"
                description="New botanical essays from our field researchers will appear shortly."
                icon="package"
            />
        @endif
    </x-container>
</section>
