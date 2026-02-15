<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminOrderListTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_orders(): void
    {
        $response = $this->get(route('admin.orders.index'));

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_admin_orders_page(): void
    {
        $user = User::factory()->create();

        Order::create([
            'customer_email' => 'john@example.com',
            'customer_name' => 'John Doe',
            'total_amount' => 100,
            'status' => 'pending',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('admin.orders.index'));

        $response->assertStatus(200);
        $response->assertSee('Admin Orders');
        $response->assertSeeLivewire('admin.order-list');
    }
}
