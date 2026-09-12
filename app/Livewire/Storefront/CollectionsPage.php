<?php

declare(strict_types=1);

namespace App\Livewire\Storefront;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CollectionsPage extends Component
{
    use WithPagination;

    #[Url(as: 'cat')]
    public ?string $cat = null;

    #[Url(as: 'q')]
    public ?string $q = null;

    public ?string $slug = null;

    public function mount(?string $slug = null): void
    {
        $this->slug = $slug;
        if (! $this->cat && $slug) {
            $this->cat = $slug;
        }
    }

    public function selectCategory(?string $categorySlug): void
    {
        $this->cat = $categorySlug;
        $this->resetPage();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /** @var Category|null $activeCategory */
        $activeCategory = null;
        if ($this->cat) {
            $activeCategory = Category::where('slug', $this->cat)->first();
        }

        /** @var Collection<int, Category> $allCategories */
        $allCategories = Category::where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->withCount('products')
            ->get();

        $query = Product::active()
            ->with(['images', 'categories'])
            ->orderByDesc('is_bestseller')
            ->orderByDesc('is_featured')
            ->orderBy('name');

        if ($this->q) {
            $query->where(function ($sq): void {
                $sq->where('name', 'ilike', '%' . $this->q . '%')
                    ->orWhere('short_description', 'ilike', '%' . $this->q . '%')
                    ->orWhere('description', 'ilike', '%' . $this->q . '%');
            });
        }

        if ($activeCategory) {
            $query->whereHas('categories', function ($q) use ($activeCategory): void {
                $q->where('categories.id', $activeCategory->id);
            });
        }

        $products = $query->paginate(12);

        if ($this->q) {
            $pageTitle = 'Search: "' . $this->q . '"';
            $pageDescription = 'Showing matching botanical harvests and reserves for "' . $this->q . '".';
        } elseif ($activeCategory) {
            $pageTitle = $activeCategory->name . ' — Curated Collections';
            $pageDescription = $activeCategory->description ?? 'Discover our meticulously crafted blends, single-origin spices, and stoneground flours.';
        } else {
            $pageTitle = 'Curated Collections';
            $pageDescription = 'Discover our meticulously crafted blends, single-origin spices, and stoneground flours.';
        }

        return view('livewire.storefront.collections-page', [
            'activeCategory' => $activeCategory,
            'allCategories' => $allCategories,
            'products' => $products,
        ])->layout('components.layouts.storefront', [
            'title' => $pageTitle,
            'description' => $pageDescription,
            'transparentHero' => false,
        ]);
    }
}
