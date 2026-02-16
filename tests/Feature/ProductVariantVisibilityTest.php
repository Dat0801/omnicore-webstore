<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductVariantVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_unpublished_variant_is_hidden_from_product_detail_attributes(): void
    {
        $parent = Product::factory()->create([
            'erp_product_id' => '1',
            'erp_parent_id' => null,
            'is_published' => true,
            'is_active_in_erp' => true,
            'has_variants' => true,
        ]);

        Product::factory()->create([
            'erp_product_id' => '2',
            'erp_parent_id' => '1',
            'is_published' => false,
            'is_active_in_erp' => true,
            'has_variants' => false,
            'variant_attributes' => [
                'color' => 'Red',
            ],
        ]);

        Product::factory()->create([
            'erp_product_id' => '3',
            'erp_parent_id' => '1',
            'is_published' => true,
            'is_active_in_erp' => true,
            'has_variants' => false,
            'variant_attributes' => [
                'color' => 'Blue',
            ],
        ]);

        $response = $this->get(route('products.show', $parent));

        $response->assertStatus(200);
        $response->assertSee('Blue');
        $response->assertDontSee('Red');
    }
}
