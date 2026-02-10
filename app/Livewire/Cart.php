<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class Cart extends Component
{
    public function updateQuantity($productId, $quantity)
    {
        app(CartService::class)->updateQuantity($productId, $quantity);
        $this->dispatch('cart-updated');
    }

    public function remove($productId)
    {
        app(CartService::class)->remove($productId);
        $this->dispatch('cart-updated');
    }

    public function addToCartFromRelated($productId)
    {
        app(CartService::class)->add($productId, 1);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $cartService = app(CartService::class);
        $cartItems = $cartService->getItems();
        $subtotal = $cartService->total();
        $shipping = 0.00;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;

        return view('livewire.cart', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total,
            'relatedProducts' => Product::published()->inRandomOrder()->take(4)->get(),
        ]);
    }
}
