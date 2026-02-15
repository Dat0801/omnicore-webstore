<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    public $status = 'all';

    public $search = '';

    public function updating($property): void
    {
        if (in_array($property, ['status', 'search'])) {
            $this->resetPage();
        }
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
        $this->resetPage();
    }

    public function render()
    {
        $query = Order::with('user')->latest();

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('id', 'like', '%'.$this->search.'%')
                    ->orWhere('erp_order_id', 'like', '%'.$this->search.'%')
                    ->orWhere('customer_email', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.admin.order-list', [
            'orders' => $query->paginate(15),
        ]);
    }
}
