@props([
    'items' => [], // Array of ['label' => 'Home', 'href' => '/']
])

<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'flex items-center text-caption text-secondary']) }}>
    <ol class="flex items-center space-x-2">
        <li>
            <a href="/" class="hover:text-accent transition-colors duration-250">Home</a>
        </li>

        @foreach ($items as $item)
            <li class="flex items-center space-x-2">
                <span class="text-muted/60" aria-hidden="true">/</span>
                @if (! empty($item['href']) && ! $loop->last)
                    <a href="{{ $item['href'] }}" class="hover:text-accent transition-colors duration-250">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="text-primary font-medium" aria-current="page">
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
