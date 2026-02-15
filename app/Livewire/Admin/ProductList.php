<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Services\ProductSyncService;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $isSyncing = false;

    public function togglePublish($productId)
    {
        $product = Product::findOrFail($productId);
        $product->is_published = ! $product->is_published;
        $product->save();
    }

    public function syncFromErp()
    {
        $this->isSyncing = true;

        try {
            $service = app(ProductSyncService::class);
            $service->syncProducts();

            session()->flash('success', 'Product sync completed successfully.');
        } catch (\Exception $e) {
            session()->flash('warning', 'Failed to sync products: '.$e->getMessage());
        } finally {
            $this->isSyncing = false;
        }
    }

    public function render()
    {
        // Admin sees all products
        $products = Product::latest()->paginate(20);

        return view('livewire.admin.product-list', [
            'products' => $products,
        ]);
    }
}
