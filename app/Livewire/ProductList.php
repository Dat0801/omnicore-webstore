<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public function render()
    {
        // Only show products that are active in ERP AND published locally
        $products = Product::published()
            ->latest()
            ->paginate(12);

        return view('livewire.product-list', [
            'products' => $products
        ]);
    }
}
