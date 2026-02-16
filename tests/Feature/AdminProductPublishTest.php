<?php

namespace Tests\Feature;

use App\Livewire\Admin\ProductList as AdminProductList;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminProductPublishTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_toggle_product_publish_status(): void
    {
        $product = Product::factory()->create([
            'is_published' => false,
            'is_active_in_erp' => true,
        ]);

        Livewire::test(AdminProductList::class)
            ->call('togglePublish', $product->id);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'is_published' => true,
        ]);

        Livewire::test(AdminProductList::class)
            ->call('togglePublish', $product->id);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'is_published' => false,
        ]);
    }
}
