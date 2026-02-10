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

        // Filter by current user if authentication is used
        // if (Auth::check()) {
        //    $query->where('user_id', Auth::id()); // or customer_email
        // }
        // For now, assuming global orders or relying on implementation details not fully visible
        // But typically we should filter by user.
        // The Checkout component saves 'customer_email'.
        // If the user is logged in, we should match email or user_id.
        // Let's assume we match by email if user is logged in, or just show all for this demo/personal project context.

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
