<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_detail_page_displays_order_and_items(): void
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'price' => 100,
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        $order = Order::create([
            'customer_email' => 'john@example.com',
            'customer_name' => 'John Doe',
            'total_amount' => 216,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'erp_product_id' => (string) $product->erp_product_id,
            'name' => $product->name,
            'quantity' => 2,
            'price' => 100,
        ]);

        $this->actingAs($user);

        $response = $this->get(route('orders.show', $order));

        $response->assertStatus(200);
        $response->assertSee('Order Details');
        $response->assertSee('#OMN-'.$order->id);
        $response->assertSee($product->name);
        $response->assertSee('216.00');
    }
}
