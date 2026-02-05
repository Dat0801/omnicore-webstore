<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected const SESSION_KEY = 'cart';

    public function add(int $productId, int $quantity = 1): void
    {
        $cart = $this->getCartFromSession();
        
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        $this->saveCartToSession($cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->getCartFromSession();
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        $this->saveCartToSession($cart);
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->getCartFromSession();
        
        if ($quantity <= 0) {
            $this->remove($productId);
            return;
        }

        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
        }

        $this->saveCartToSession($cart);
    }

    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    public function getItems(): Collection
    {
        $cart = $this->getCartFromSession();

        if (empty($cart)) {
            return collect([]);
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        return $products->map(function ($product) use ($cart) {
            $product->cart_quantity = $cart[$product->id];
            $product->total_price = $product->price * $product->cart_quantity;
            return $product;
        });
    }

    public function total(): float
    {
        return $this->getItems()->sum('total_price');
    }

    public function count(): int
    {
        return array_sum($this->getCartFromSession());
    }

    protected function getCartFromSession(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    protected function saveCartToSession(array $cart): void
    {
        Session::put(self::SESSION_KEY, $cart);
    }
}
