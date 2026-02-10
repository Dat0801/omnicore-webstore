<?php

namespace Tests\Feature;

use App\Livewire\Checkout;
use App\Livewire\ProductList;
use App\Models\Product;
use App\Services\CartService;
use App\Services\OrderSubmissionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Mockery;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_add_to_cart()
    {
        $product = Product::factory()->create([
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        Livewire::test(ProductList::class)
            ->call('addToCart', $product->id)
            ->assertDispatched('cart-updated');

        $this->assertEquals(1, app(CartService::class)->count());
    }

    public function test_checkout_creates_order_and_submits_to_erp()
    {
        $product = Product::factory()->create([
            'price' => 100,
            'erp_product_id' => 999,
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        app(CartService::class)->add($product->id, 2);

        $mockSubmissionService = Mockery::mock(OrderSubmissionService::class);
        $mockSubmissionService->shouldReceive('submitOrder')
            ->once()
            ->andReturn(true);

        $this->app->instance(OrderSubmissionService::class, $mockSubmissionService);

        Livewire::test(Checkout::class)
            ->set('customer_name', 'John Doe')
            ->set('customer_email', 'john@example.com')
            ->call('submit')
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('orders', [
            'customer_email' => 'john@example.com',
            'total_amount' => 200,
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $this->assertEquals(0, app(CartService::class)->count());
    }
}
