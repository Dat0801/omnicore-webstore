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
}
