<?php

declare(strict_types=1);

namespace App\Livewire\Storefront;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;

class SearchOverlay extends Component
{
    public bool $isOpen = false;

    public string $query = '';

    /**
     * @var array<string>
     */
    public array $popularSearches = [
        'First Flush Darjeeling',
        'Kashmir Mogra Saffron',
        'Silver Needle White Tea',
        'Malabar Green Cardamom',
        'Porcelain Cloche Gift Set',
    ];

    #[On('open-search')]
    public function openSearch(): void
    {
        $this->isOpen = true;
    }

    #[On('close-search')]
    public function closeSearch(): void
    {
        $this->isOpen = false;
        $this->query = '';
    }

    public function selectPopular(string $term): void
    {
        $this->query = $term;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $results = new Collection;
        $featuredCategories = new Collection;

        if (strlen(trim($this->query)) >= 2) {
            $results = Product::active()
                ->where(function ($q): void {
                    $q->where('name', 'ilike', '%'.$this->query.'%')
                        ->orWhere('short_description', 'ilike', '%'.$this->query.'%')
                        ->orWhere('description', 'ilike', '%'.$this->query.'%');
                })
                ->with(['categories', 'images'])
                ->take(6)
                ->get();
        } else {
            /** @var Collection<int, Category> $featuredCategories */
            $featuredCategories = Cache::tags(['categories'])->remember('search_featured_categories', 3600, function (): Collection {
                return Category::where('is_featured', true)->take(4)->get();
            });
        }

        return view('livewire.storefront.search-overlay', [
            'results' => $results,
            'featuredCategories' => $featuredCategories,
        ]);
    }
}
