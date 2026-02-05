<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;
use Livewire\Attributes\On;

class CartIcon extends Component
{
    public $count = 0;

    public function mount()
    {
        $this->updateCount();
    }

    #[On('cart-updated')]
    public function updateCount()
    {
        $this->count = app(CartService::class)->count();
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
