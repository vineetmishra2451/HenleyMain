<?php

declare(strict_types=1);

namespace App\Livewire\Storefront;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SearchOverlay extends Component
{
    public string $query = '';

    public bool $isOpen = false;

    /**
     * @var list<string>
     */
    public array $popularSearches = [
        'First Flush Darjeeling',
        'Kashmiri Saffron Mogra',
        'Tellicherry Black Pepper',
        'Imperial Silver Needle',
        'Malabar Green Cardamom',
        'Nilgiri Blue Mountain Tisane',
    ];

    /**
     * @var array<string, mixed>
     */
    protected $listeners = [
        'open-search' => 'open',
        'close-search' => 'close',
    ];

    public function open(): void
    {
        $this->isOpen = true;
    }

    public function close(): void
    {
        $this->isOpen = false;
        $this->query = '';
    }

    public function selectPopular(string $term): void
    {
        $this->query = $term;
    }

    public function render(): View
    {
        /** @var Collection<int, Product> $results */
        $results = new Collection;

        if (strlen(trim($this->query)) >= 2) {
            $results = Product::query()
                ->active()
                ->search($this->query)
                ->with(['vendor', 'categories'])
                ->take(6)
                ->get();
        }

        return view('livewire.storefront.search-overlay', [
            'results' => $results,
        ]);
    }
}
