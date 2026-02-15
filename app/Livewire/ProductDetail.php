<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public $quantity = 1;

    public ?Product $selectedVariant = null;

    public array $selectedAttributes = [];

    public array $availableAttributes = [];

    public function mount(Product $product)
    {
        if (! $product->is_published || ! $product->is_active_in_erp) {
            abort(404);
        }

        $this->product = $product->load('variants');

        $this->buildAttributesFromVariants();
        $this->updateSelectedVariant();
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function selectAttribute(string $name, string $value): void
    {
        $this->selectedAttributes[$name] = $value;
        $this->updateSelectedVariant();
    }

    public function addToCart()
    {
        $cartService = app(CartService::class);
        $productId = $this->selectedVariant?->id ?? $this->product->id;
        $cartService->add($productId, $this->quantity);

        $this->dispatch('cart-updated');
        session()->flash('success', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.product-detail')
            ->layout('components.layouts.app'); // Ensure it uses the app layout
    }

    protected function buildAttributesFromVariants(): void
    {
        if ($this->product->variants->isEmpty()) {
            return;
        }

        $attributes = [];

        foreach ($this->product->variants as $variant) {
            $variantAttributes = $variant->variant_attributes ?? [];

            foreach ($variantAttributes as $name => $value) {
                $attributes[$name] ??= [];

                if (! in_array($value, $attributes[$name], true)) {
                    $attributes[$name][] = $value;
                }
            }
        }

        $this->availableAttributes = $attributes;

        foreach ($this->availableAttributes as $name => $values) {
            if (! isset($this->selectedAttributes[$name]) && ! empty($values)) {
                $this->selectedAttributes[$name] = $values[0];
            }
        }
    }

    protected function updateSelectedVariant(): void
    {
        if ($this->product->variants->isEmpty()) {
            $this->selectedVariant = null;

            return;
        }

        $this->selectedVariant = $this->product->variants->first(function (Product $variant) {
            $attributes = $variant->variant_attributes ?? [];

            foreach ($this->selectedAttributes as $name => $value) {
                if (! array_key_exists($name, $attributes) || $attributes[$name] !== $value) {
                    return false;
                }
            }

            return true;
        });
    }
}
