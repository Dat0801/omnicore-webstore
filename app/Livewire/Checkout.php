<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\OrderSubmissionService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    public $customer_name;
    public $customer_email;

    protected $rules = [
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'required|email|max:255',
    ];

    public function submit()
    {
        $this->validate();

        $cartService = app(CartService::class);
        $items = $cartService->getItems();

        if ($items->isEmpty()) {
            session()->flash('warning', 'Your cart is empty.');
            return redirect()->route('cart.index');
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'customer_name' => $this->customer_name,
                'customer_email' => $this->customer_email,
                'total_amount' => $cartService->total(),
                'status' => 'pending',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'erp_product_id' => $item->erp_product_id,
                    'name' => $item->name,
                    'quantity' => $item->cart_quantity,
                    'price' => $item->price,
                ]);
            }

            DB::commit();

            // Submit to ERP
            $submissionService = app(OrderSubmissionService::class);
            $success = $submissionService->submitOrder($order);

            $cartService->clear();

            if ($success) {
                session()->flash('success', 'Order placed successfully! Order ID: ' . $order->id);
            } else {
                session()->flash('warning', 'Order placed locally but failed to send to ERP. Order ID: ' . $order->id);
            }

            return redirect()->route('home');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $cartService = app(CartService::class);
        return view('livewire.checkout', [
            'cartItems' => $cartService->getItems(),
            'total' => $cartService->total(),
        ]);
    }
}
