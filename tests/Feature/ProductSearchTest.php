<?php

namespace Tests\Feature;

use App\Livewire\ProductList;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_search_products_by_name_and_description(): void
    {
        Product::factory()->create([
            'name' => 'Red T-Shirt',
            'description' => 'Comfortable cotton tee',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        Product::factory()->create([
            'name' => 'Blue Jeans',
            'description' => 'Denim pants',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        $component = Livewire::test(ProductList::class, [
            'sidebar' => true,
            'pagination' => false,
            'limit' => 10,
        ]);

        $component->set('search', 'T-Shirt')
            ->assertSee('Red T-Shirt')
            ->assertDontSee('Blue Jeans');

        $component->set('search', 'Denim')
            ->assertSee('Blue Jeans')
            ->assertDontSee('Red T-Shirt');
    }

    public function test_header_search_redirects_to_products_page_with_results(): void
    {
        Product::factory()->create([
            'name' => 'Green Hoodie',
            'description' => 'Cozy fleece hoodie',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        Product::factory()->create([
            'name' => 'Black Jacket',
            'description' => 'Waterproof outerwear',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        $response = $this->get(route('products.index', ['search' => 'Hoodie']));

        $response->assertStatus(200);
        $response->assertSee('Green Hoodie');
        $response->assertDontSee('Black Jacket');
    }
}
