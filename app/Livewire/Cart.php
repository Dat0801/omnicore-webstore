<?php

namespace App\Livewire;

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

    public function render()
    {
        $cartService = app(CartService::class);
        
        return view('livewire.cart', [
            'cartItems' => $cartService->getItems(),
            'total' => $cartService->total(),
        ]);
    }
}
