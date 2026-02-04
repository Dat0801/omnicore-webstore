<?php

use Livewire\Component;
use Illuminate\Support\Facades\Session;

new class extends Component
{
    protected $listeners = ['cart-updated' => '$refresh'];

    public function removeFromCart($productId)
    {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::put('cart', $cart);
        $this->dispatch('cart-updated');
    }
    
    public function with()
    {
        $cart = Session::get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        
        return [
            'cartItems' => $cart,
            'total' => $total,
        ];
    }
};
?>

<div class="p-6 bg-white rounded shadow sticky top-4">
    <h2 class="text-2xl font-bold mb-4">Shopping Cart</h2>
    @if(empty($cartItems))
        <p class="text-gray-500">Your cart is empty.</p>
    @else
        <ul class="divide-y divide-gray-200 mb-4">
            @foreach($cartItems as $productId => $item)
                <li class="py-3 flex justify-between items-start">
                    <div>
                        <h4 class="font-medium">{{ $item['name'] }}</h4>
                        <p class="text-sm text-gray-500">{{ $item['quantity'] }} x ${{ number_format($item['price'], 2) }}</p>
                    </div>
                    <div class="text-right">
                        <div class="font-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                        <button wire:click="removeFromCart({{ $productId }})" class="text-xs text-red-500 hover:text-red-700 underline">Remove</button>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="border-t pt-4">
            <div class="flex justify-between text-xl font-bold mb-4">
                <span>Total:</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
            <a href="/checkout" class="block text-center w-full bg-green-600 text-white py-3 rounded hover:bg-green-700 transition">
                Proceed to Checkout
            </a>
        </div>
    @endif
</div>
