<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductVariantListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_listing_shows_only_parent_products(): void
    {
        $parent = Product::factory()->create([
            'erp_product_id' => '1',
            'erp_parent_id' => null,
            'is_published' => true,
            'is_active_in_erp' => true,
            'has_variants' => true,
        ]);

        $variant = Product::factory()->create([
            'erp_product_id' => '2',
            'erp_parent_id' => '1',
            'is_published' => true,
            'is_active_in_erp' => true,
            'has_variants' => false,
        ]);

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee($parent->name);
        $response->assertDontSee($variant->name);
    }
}
