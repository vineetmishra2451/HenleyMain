@props([
    'title' => 'Single-Estate Black Teas',
    'subtitle' => 'Elevation 1,200m – 2,200m',
    'description' => 'Unblended orthodox leaves picked across premier Himalayan terroir.',
    'image' => null,
    'href' => '#',
    'archMotif' => false,
])

<div {{ $attributes->merge(['class' => 'group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-hairline bg-surface-raised p-6 sm:p-8 transition-all duration-350 ease-henley hover:border-muted hover:shadow-hover']) }}>
    <div>
        <!-- Optional Arched Image portal -->
        <div class="relative w-full aspect-[4/3] overflow-hidden {{ $archMotif ? 'rounded-arch border border-hairline' : 'rounded-xl' }} bg-surface-raised mb-6">
            @if ($image)
                <img
                    src="{{ $image }}"
                    alt="{{ $title }}"
                    loading="lazy"
                    class="h-full w-full object-cover object-center transition-transform duration-500 ease-henley group-hover:scale-[1.03]"
                >
            @else
                <div class="flex h-full w-full items-center justify-center bg-surface-raised/80 text-muted">
                    <x-icons.package class="h-16 w-16 stroke-[1]" />
                </div>
            @endif
        </div>

        <div class="space-y-2">
            <x-eyebrow variant="accent">
                {{ $subtitle }}
            </x-eyebrow>

            <h3 class="font-serif text-display-2 font-normal text-primary group-hover:text-accent transition-colors duration-250">
                {{ $title }}
            </h3>

            @if ($description)
                <p class="text-body text-secondary line-clamp-2">
                    {{ $description }}
                </p>
            @endif
        </div>
    </div>

    <div class="mt-6 pt-4 border-t border-hairline flex items-center justify-between">
        <a href="{{ $href }}" class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-accent group-hover:text-accent-hover inline-flex items-center gap-1.5">
            <span>Explore Collection</span>
            <span class="inline-block transition-transform duration-250 ease-henley group-hover:translate-x-1">→</span>
        </a>
    </div>
</div>
