<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\OrderSubmissionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    // Shipping Information
    public $first_name;

    public $last_name;

    public $email;

    public $address;

    public $city;

    public $state;

    public $zip_code;

    // Payment Information
    public $payment_method = 'credit_card'; // 'credit_card' or 'paypal'

    public $card_number;

    public $card_expiry;

    public $card_cvc;

    // Order Summary
    public $promo_code;

    protected function rules()
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'payment_method' => 'required|in:credit_card,paypal',
        ];

        if ($this->payment_method === 'credit_card') {
            $rules['card_number'] = 'required|string|min:16|max:19'; // Simple validation
            $rules['card_expiry'] = 'required|string';
            $rules['card_cvc'] = 'required|string|min:3|max:4';
        }

        return $rules;
    }

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

            // Calculate shipping and tax (mock implementation)
            $subtotal = $cartService->total();
            $shipping = 0; // Free shipping as per screenshot
            $tax = $subtotal * 0.08; // 8% tax example
            $total = $subtotal + $shipping + $tax;

            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $this->first_name.' '.$this->last_name,
                'customer_email' => $this->email,
                'shipping_first_name' => $this->first_name,
                'shipping_last_name' => $this->last_name,
                'shipping_address' => $this->address,
                'shipping_city' => $this->city,
                'shipping_state' => $this->state,
                'shipping_zip' => $this->zip_code,
                'payment_method' => $this->payment_method,
                'total_amount' => $total,
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
                session()->flash('success', 'Order placed successfully! Order ID: '.$order->id);
            } else {
                session()->flash('warning', 'Order placed locally but failed to send to ERP. Order ID: '.$order->id);
            }

            return redirect()->route('home');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to place order: '.$e->getMessage());
        }
    }

    public function render()
    {
        $cartService = app(CartService::class);
        $subtotal = $cartService->total();
        $shipping = 0;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;

        return view('livewire.checkout', [
            'cartItems' => $cartService->getItems(),
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total,
        ]);
    }
}
