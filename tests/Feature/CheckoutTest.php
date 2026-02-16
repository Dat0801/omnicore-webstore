<?php

namespace Tests\Feature;

use App\Livewire\Checkout;
use App\Livewire\ProductList;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('email', 'john@example.com')
            ->set('address', '123 Main St')
            ->set('city', 'Hanoi')
            ->set('state', 'HN')
            ->set('zip_code', '100000')
            ->set('payment_method', 'paypal')
            ->call('submit')
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('orders', [
            'customer_email' => 'john@example.com',
            'total_amount' => 216,
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $this->assertEquals(0, app(CartService::class)->count());
    }

    public function test_checkout_sets_user_id_when_authenticated()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'price' => 100,
            'erp_product_id' => 999,
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        app(CartService::class)->add($product->id, 1);

        $this->actingAs($user);

        $mockSubmissionService = Mockery::mock(OrderSubmissionService::class);
        $mockSubmissionService->shouldReceive('submitOrder')
            ->once()
            ->andReturn(true);

        $this->app->instance(OrderSubmissionService::class, $mockSubmissionService);

        Livewire::test(Checkout::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('email', $user->email)
            ->set('address', '123 Main St')
            ->set('city', 'Hanoi')
            ->set('state', 'HN')
            ->set('zip_code', '100000')
            ->set('payment_method', 'paypal')
            ->call('submit')
            ->assertRedirect(route('home'));

        $order = Order::first();

        $this->assertNotNull($order);
        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals($user->email, $order->customer_email);
    }
}
