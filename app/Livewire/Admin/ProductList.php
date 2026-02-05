<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public function togglePublish($productId)
    {
        $product = Product::findOrFail($productId);
        $product->is_published = !$product->is_published;
        $product->save();
    }

    public function render()
    {
        // Admin sees all products
        $products = Product::latest()->paginate(20);

        return view('livewire.admin.product-list', [
            'products' => $products
        ]);
    }
}
