<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public function addToCart(int $productId)
    {
        $cartService = app(CartService::class);
        $cartService->add($productId);
        
        $this->dispatch('cart-updated');
        session()->flash('success', 'Product added to cart!');
    }

    public function render()
    {
        // Only show products that are active in ERP AND published locally
        $products = Product::published()
            ->latest()
            ->paginate(12);

        return view('livewire.product-list', [
            'products' => $products
        ]);
    }
}
