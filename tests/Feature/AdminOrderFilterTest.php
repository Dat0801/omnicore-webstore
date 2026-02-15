<?php

namespace Tests\Feature;

use App\Livewire\Admin\OrderList as AdminOrderList;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminOrderFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_filter_orders_by_status_and_search(): void
    {
        $pending = Order::create([
            'customer_email' => 'pending@example.com',
            'customer_name' => 'Pending User',
            'total_amount' => 120,
            'status' => 'pending',
        ]);

        $delivered = Order::create([
            'customer_email' => 'delivered@example.com',
            'customer_name' => 'Delivered User',
            'total_amount' => 200,
            'status' => 'delivered',
        ]);

        Livewire::test(AdminOrderList::class)
            ->set('status', 'pending')
            ->assertSee('pending@example.com')
            ->assertDontSee('delivered@example.com')
            ->set('status', 'delivered')
            ->assertSee('delivered@example.com')
            ->assertDontSee('pending@example.com')
            ->set('search', 'pending@example.com')
            ->set('status', 'all')
            ->assertSee('pending@example.com')
            ->assertDontSee('delivered@example.com');
    }
}
