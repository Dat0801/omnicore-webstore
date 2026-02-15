<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductListTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_products(): void
    {
        $response = $this->get(route('admin.products.index'));

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_see_admin_product_list(): void
    {
        $user = User::factory()->create();

        Product::factory()->count(3)->create([
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        $this->actingAs($user);

        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(200);
        $response->assertSee('Admin Products');
        $response->assertSeeLivewire('admin.product-list');
    }
}
