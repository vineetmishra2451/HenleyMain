@props([
    'type' => 'single', // single | multiple
])

<div
    x-data="{
        type: '{{ $type }}',
        activeItems: [],
        toggle(id) {
            if (this.type === 'single') {
                this.activeItems = this.activeItems.includes(id) ? [] : [id];
            } else {
                if (this.activeItems.includes(id)) {
                    this.activeItems = this.activeItems.filter(i => i !== id);
                } else {
                    this.activeItems.push(id);
                }
            }
        },
        isOpen(id) {
            return this.activeItems.includes(id);
        }
    }"
    {{ $attributes->merge(['class' => 'w-full divide-y divide-hairline border-y border-hairline']) }}
>
    {{ $slot }}
</div>
