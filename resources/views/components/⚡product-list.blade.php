<?php

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

new class extends Component
{
    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        $cart = Session::get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'erp_product_id' => $product->erp_product_id,
                'quantity' => 1,
            ];
        }
        
        Session::put('cart', $cart);
        $this->dispatch('cart-updated'); 
    }
    
    public function with()
    {
        return [
            'products' => Product::where('is_published', true)->get(),
        ];
    }
};
?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($products as $product)
        <div class="border rounded-lg p-4 shadow-sm bg-white">
            @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4 rounded">
            @else
                <div class="w-full h-48 bg-gray-200 mb-4 rounded flex items-center justify-center text-gray-500">No Image</div>
            @endif
            <h3 class="text-lg font-bold">{{ $product->name }}</h3>
            <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
            <button wire:click="addToCart({{ $product->id }})" class="mt-4 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Add to Cart
            </button>
        </div>
    @endforeach
</div>
