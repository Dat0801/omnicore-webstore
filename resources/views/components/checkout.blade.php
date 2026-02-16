<?php

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderSubmissionService;

new class extends Component
{
    public $email;
    public $name;
    
    public function mount()
    {
        if (empty(Session::get('cart'))) {
            return redirect('/');
        }
    }
    
    public function placeOrder(OrderSubmissionService $orderService)
    {
        $this->validate([
            'email' => 'required|email',
            'name' => 'required|string',
        ]);
        
        $cart = Session::get('cart', []);
        if (empty($cart)) return redirect('/');

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        
        // Create Order
        $order = Order::create([
            'customer_email' => $this->email,
            'customer_name' => $this->name,
            'total_amount' => $total,
            'status' => 'pending',
        ]);
        
        // Create Items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'erp_product_id' => $item['erp_product_id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
        
        // Submit to ERP
        $success = $orderService->submitOrder($order);
        
        Session::forget('cart');
        
        if ($success) {
            session()->flash('success', 'Order placed successfully and sent to ERP!');
        } else {
            session()->flash('warning', 'Order placed locally. We will retry sending to ERP soon.');
        }
        
        return redirect('/');
    }
};
?>

<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6">Checkout</h2>
    
    <form wire:submit="placeOrder" class="space-y-4">
        <div>
            <label class="block font-medium mb-1">Full Name</label>
            <input type="text" wire:model="name" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block font-medium mb-1">Email Address</label>
            <input type="email" wire:model="email" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700 font-bold transition">
                Place Order
            </button>
        </div>
        
        <div class="text-center mt-4">
            <a href="/" class="text-gray-500 underline">Back to Shopping</a>
        </div>
    </form>
</div>
