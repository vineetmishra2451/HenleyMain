@props([
    'stats' => [], // Array of ['value' => '1,200m', 'label' => 'Elevation', 'caption' => 'High mountain mist']
])

<div {{ $attributes->merge(['class' => 'grid grid-cols-2 md:grid-cols-4 gap-6 py-8 border-y border-hairline my-12']) }}>
    @foreach ($stats as $stat)
        <div class="text-center px-4 space-y-1">
            <div class="font-serif text-3xl sm:text-4xl font-normal text-primary tracking-tight">
                {{ $stat['value'] }}
            </div>
            <div class="text-xs uppercase tracking-[0.16em] font-semibold text-accent">
                {{ $stat['label'] }}
            </div>
            @if (! empty($stat['caption']))
                <p class="text-caption text-secondary">
                    {{ $stat['caption'] }}
                </p>
            @endif
        </div>
    @endforeach

    {{ $slot }}
</div>
