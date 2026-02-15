<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_history_shows_only_authenticated_users_orders(): void
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
        ]);

        $otherUser = User::factory()->create([
            'email' => 'other@example.com',
        ]);

        $userOrder = Order::create([
            'user_id' => $user->id,
            'customer_email' => 'user@example.com',
            'customer_name' => 'User One',
            'total_amount' => 100,
            'status' => 'pending',
        ]);

        $otherOrder = Order::create([
            'user_id' => $otherUser->id,
            'customer_email' => 'other@example.com',
            'customer_name' => 'User Two',
            'total_amount' => 200,
            'status' => 'pending',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('orders.index'));

        $response->assertStatus(200);
        $response->assertSee('#OMN-'.$userOrder->id);
        $response->assertDontSee('#OMN-'.$otherOrder->id);
    }
}
