<?php

namespace Tests\Feature;

use App\Models\CategoryDisplay;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminCategoryOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_save_category_order(): void
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

        Livewire::test('admin.category-order')
            ->call('reorder', ['Lenses', 'Cameras'])
            ->call('save');

        $this->assertDatabaseHas('category_displays', [
            'name' => 'Lenses',
            'sort_order' => 1,
        ]);

        $this->assertDatabaseHas('category_displays', [
            'name' => 'Cameras',
            'sort_order' => 2,
        ]);

        $this->assertSame(2, CategoryDisplay::count());
    }
}
