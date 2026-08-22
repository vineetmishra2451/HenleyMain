@props([
    'author' => null,
    'title' => null,
])

<figure {{ $attributes->merge(['class' => 'my-12 relative max-w-3xl mx-auto text-center px-6 py-10 bg-surface-raised/40 rounded-2xl border border-hairline']) }}>
    <!-- Delicate gold quotation glyph -->
    <div class="font-serif text-5xl text-gold/60 leading-none select-none mb-3" aria-hidden="true">“</div>

    <blockquote class="font-serif text-display-3 text-primary italic font-normal leading-snug">
        {{ $slot }}
    </blockquote>

    @if ($author)
        <figcaption class="mt-6 flex flex-col items-center">
            <cite class="not-italic font-sans text-xs uppercase tracking-[0.16em] font-semibold text-primary">
                {{ $author }}
            </cite>
            @if ($title)
                <span class="font-sans text-caption text-secondary mt-0.5">
                    {{ $title }}
                </span>
            @endif
        </figcaption>
    @endif
</figure>
