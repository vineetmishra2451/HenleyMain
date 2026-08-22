@props([
    'items' => [
        [
            'icon' => 'leaf',
            'label' => 'Single-Estate Origin',
            'caption' => 'Traceable directly to prime mountain slopes',
        ],
        [
            'icon' => 'package',
            'label' => 'Apothecary Sealed',
            'caption' => 'Flushed with nitrogen in bone porcelain tins',
        ],
        [
            'icon' => 'truck',
            'label' => 'Complimentary Delivery',
            'caption' => 'Express air courier on orders over ₹1,500',
        ],
        [
            'icon' => 'shield-check',
            'label' => '100% Biodynamic Purity',
            'caption' => 'Zero synthetic pesticides or artificial aromas',
        ],
    ],
])

<div {{ $attributes->merge(['class' => 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 py-10 px-6 sm:px-10 rounded-2xl bg-surface-raised border border-hairline my-12']) }}>
    @foreach ($items as $item)
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-gold-surface border border-gold/30 text-gold-text">
                @if (($item['icon'] ?? '') === 'leaf')
                    <x-icons.leaf class="w-5 h-5" />
                @elseif (($item['icon'] ?? '') === 'package')
                    <x-icons.package class="w-5 h-5" />
                @elseif (($item['icon'] ?? '') === 'truck')
                    <x-icons.truck class="w-5 h-5" />
                @elseif (($item['icon'] ?? '') === 'shield-check')
                    <x-icons.shield-check class="w-5 h-5" />
                @elseif (($item['icon'] ?? '') === 'clock')
                    <x-icons.clock class="w-5 h-5" />
                @else
                    <x-icons.sparkles class="w-5 h-5" />
                @endif
            </div>

            <div class="space-y-0.5">
                <h4 class="font-sans text-xs uppercase tracking-[0.14em] font-semibold text-primary">
                    {{ $item['label'] }}
                </h4>
                @if (! empty($item['caption']))
                    <p class="font-sans text-caption text-secondary leading-snug">
                        {{ $item['caption'] }}
                    </p>
                @endif
            </div>
        </div>
    @endforeach
</div>
