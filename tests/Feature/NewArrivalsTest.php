<?php

namespace Tests\Feature;

use App\Livewire\ProductList;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class NewArrivalsTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_list_shows_products_from_last_seven_days(): void
    {
        Product::factory()->create([
            'name' => 'Recent Headphones',
            'is_published' => true,
            'is_active_in_erp' => true,
            'created_at' => now()->subDays(2),
        ]);

        Product::factory()->create([
            'name' => 'Sale Item Laptop',
            'is_published' => true,
            'is_active_in_erp' => true,
            'created_at' => now()->subDays(10),
        ]);

        Product::factory()->create([
            'name' => 'Regular Keyboard',
            'is_published' => true,
            'is_active_in_erp' => true,
            'created_at' => now()->subDays(30),
        ]);

        $component = Livewire::test(ProductList::class, [
            'sidebar' => false,
            'pagination' => false,
            'limit' => 10,
            'newArrivalsDays' => 7,
        ]);

        $component->assertSee('Recent Headphones')
            ->assertDontSee('Sale Item Laptop')
            ->assertDontSee('Regular Keyboard');
    }
}
