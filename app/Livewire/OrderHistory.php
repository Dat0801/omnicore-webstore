<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistory extends Component
{
    use WithPagination;

    public $filter = 'all';

    public $search = '';

    public function setFilter($status)
    {
        $this->filter = $status;
        $this->resetPage();
    }

    public function downloadInvoices()
    {
        // Placeholder for download functionality
        session()->flash('success', 'Downloading invoices...');
    }

    public function render()
    {
        $query = Order::query();

        if (Auth::check()) {
            $user = Auth::user();

            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('customer_email', $user->email);
            });
        }

        if ($this->filter !== 'all') {
            if ($this->filter === 'delivered') {
                $query->where('status', 'delivered');
            } elseif ($this->filter === 'processing') {
                $query->whereIn('status', ['processing', 'pending', 'in_transit']);
            } elseif ($this->filter === 'cancelled') {
                $query->where('status', 'cancelled');
            }
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('id', 'like', '%'.$this->search.'%')
                    ->orWhere('erp_order_id', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.order-history', [
            'orders' => $query->latest()->paginate(5),
        ]);
    }
}
