<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_featured_products_widget_without_sidebar()
    {
        // Create some published products
        Product::factory()->count(5)->create([
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Featured Products');
        // Should NOT see sidebar elements like "Price Range"
        $response->assertDontSee('Price Range');
        $response->assertSeeLivewire('product-list');
    }

    public function test_products_page_shows_full_list_with_sidebar()
    {
        Product::factory()->count(5)->create([
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        $response = $this->get('/products');

        $response->assertStatus(200);
        // Should see sidebar elements
        $response->assertSee('Price Range');
        $response->assertSee('Categories');
        $response->assertSeeLivewire('product-list');
    }
}
