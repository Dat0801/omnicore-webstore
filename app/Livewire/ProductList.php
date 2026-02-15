<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $selectedCategories = [];

    public $priceMin = 0;

    public $priceMax = 3500;

    public $minRating = 0;

    public $search = '';

    public $sortBy = 'newest';

    public $viewMode = 'grid';

    public $sidebar = true;

    public $pagination = true;

    public $limit = 12;

    public function mount($sidebar = true, $pagination = true, $limit = 12)
    {
        $this->sidebar = $sidebar;
        $this->pagination = $pagination;
        $this->limit = $limit;
    }

    protected $queryString = [
        'selectedCategories' => ['except' => []],
        'priceMin' => ['except' => 0],
        'priceMax' => ['except' => 3500],
        'minRating' => ['except' => 0],
        'sortBy' => ['except' => 'newest'],
        'search' => ['except' => ''],
    ];

    public function addToCart(int $productId)
    {
        $cartService = app(CartService::class);
        $cartService->add($productId);

        $this->dispatch('cart-updated');
        session()->flash('success', 'Product added to cart!');
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['selectedCategories', 'priceMin', 'priceMax', 'minRating', 'sortBy', 'search'])) {
            $this->resetPage();
        }
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
    }

    public function render()
    {
        $query = Product::published()->whereNull('erp_parent_id');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            });
        }

        // Filter by Category
        if (! empty($this->selectedCategories)) {
            $query->whereIn('category', $this->selectedCategories);
        }

        // Filter by Price
        $query->whereBetween('price', [$this->priceMin, $this->priceMax]);

        // Filter by Rating
        if ($this->minRating > 0) {
            $query->where('rating', '>=', $this->minRating);
        }

        // Sorting
        switch ($this->sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        if ($this->pagination) {
            $products = $query->paginate($this->limit);
        } else {
            $products = $query->take($this->limit)->get();
        }

        // Get categories for sidebar
        $categories = Product::published()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->orderBy('category')
            ->pluck('category');

        return view('livewire.product-list', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
