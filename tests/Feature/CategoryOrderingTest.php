<?php

namespace Tests\Feature;

use App\Models\CategoryDisplay;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryOrderingTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_are_sorted_by_custom_order_when_defined(): void
    {
        Product::factory()->create([
            'category' => 'Cameras',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        Product::factory()->create([
            'category' => 'Lenses',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        Product::factory()->create([
            'category' => 'Accessories',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        CategoryDisplay::create([
            'name' => 'Lenses',
            'sort_order' => 1,
        ]);

        CategoryDisplay::create([
            'name' => 'Accessories',
            'sort_order' => 2,
        ]);

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSeeInOrder([
            'Lenses',
            'Accessories',
            'Cameras',
        ]);
    }

    public function test_header_uses_category_display_order(): void
    {
        Product::factory()->create([
            'category' => 'Cameras',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        Product::factory()->create([
            'category' => 'Lenses',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        Product::factory()->create([
            'category' => 'Accessories',
            'is_published' => true,
            'is_active_in_erp' => true,
        ]);

        CategoryDisplay::create([
            'name' => 'Lenses',
            'sort_order' => 1,
        ]);

        CategoryDisplay::create([
            'name' => 'Accessories',
            'sort_order' => 2,
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSeeInOrder([
            'Lenses',
            'Accessories',
            'Cameras',
        ]);
        $response->assertSee('selectedCategories%5B0%5D=Lenses');
    }
}
