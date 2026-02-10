<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public $quantity = 1;

    public $selectedColor = 'Space Gray'; // Default color from design

    public function mount(Product $product)
    {
        $this->product = $product;
        // Ensure we handle published status check either here or in route binding
        if (! $product->is_published) {
            abort(404);
        }
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $cartService = app(CartService::class);
        $cartService->add($this->product->id, $this->quantity);

        $this->dispatch('cart-updated');
        session()->flash('success', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.product-detail')
            ->layout('components.layouts.app'); // Ensure it uses the app layout
    }
}
