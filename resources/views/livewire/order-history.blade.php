<div class="flex-1">
    <!-- Breadcrumbs -->
    <nav class="flex items-center text-sm text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-slate-900 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('dashboard') }}" class="hover:text-slate-900 transition">Account</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-semibold text-slate-900">Order History</span>
    </nav>

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">My Orders</h1>
            <p class="mt-2 text-slate-500">Track, manage, and review your recent OMNICORE purchases.</p>
        </div>
        <a href="{{ route('orders.download') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Download All Invoices
        </a>
    </div>

    <!-- Filters -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
        <div class="flex p-1 bg-slate-100 rounded-lg w-full sm:w-auto">
            <button 
                wire:click="setFilter('all')"
                class="flex-1 sm:flex-none px-4 py-2 text-sm font-medium rounded-md transition {{ $filter === 'all' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900' }}"
            >
                All Orders
            </button>
            <button 
                wire:click="setFilter('delivered')"
                class="flex-1 sm:flex-none px-4 py-2 text-sm font-medium rounded-md transition {{ $filter === 'delivered' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900' }}"
            >
                Delivered
            </button>
            <button 
                wire:click="setFilter('processing')"
                class="flex-1 sm:flex-none px-4 py-2 text-sm font-medium rounded-md transition {{ $filter === 'processing' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900' }}"
            >
                Processing
            </button>
            <button 
                wire:click="setFilter('cancelled')"
                class="flex-1 sm:flex-none px-4 py-2 text-sm font-medium rounded-md transition {{ $filter === 'cancelled' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900' }}"
            >
                Cancelled
            </button>
        </div>

        <button class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg text-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            More Filters
        </button>
    </div>

    <!-- Orders Table -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/50 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <a href="{{ route('orders.show', $order) }}" class="font-bold text-blue-600 hover:text-blue-700 hover:underline">
                                    #OMN-{{ $order->erp_order_id ?? $order->id }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClass = match(strtolower($order->status)) {
                                        'delivered' => 'bg-green-100 text-green-700',
                                        'processing', 'pending', 'in_transit' => 'bg-blue-100 text-blue-700',
                                        'cancelled' => 'bg-slate-100 text-slate-600',
                                        default => 'bg-slate-100 text-slate-600'
                                    };
                                    $dotClass = match(strtolower($order->status)) {
                                        'delivered' => 'bg-green-500',
                                        'processing', 'pending', 'in_transit' => 'bg-blue-500',
                                        'cancelled' => 'bg-slate-500',
                                        default => 'bg-slate-500'
                                    };
                                    $statusLabel = ucfirst($order->status);
                                    if(in_array(strtolower($order->status), ['processing', 'pending'])) $statusLabel = 'Processing';
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold {{ $statusClass }}">
                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full {{ $dotClass }}"></span>
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    @if(in_array(strtolower($order->status), ['in_transit', 'processing', 'pending']))
                                        <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center gap-1.5 rounded-md bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 hover:bg-blue-100 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Track
                                        </a>
                                    @endif
                                    <a href="{{ route('orders.show', $order) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">View Details</a>
                                    <button class="text-slate-400 hover:text-slate-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p class="text-lg font-medium text-slate-900">No orders found</p>
                                    <p class="text-sm text-slate-500 mt-1">We couldn't find any orders matching your filters.</p>
                                    <button wire:click="setFilter('all')" class="mt-4 text-blue-600 font-medium hover:underline">
                                        Clear Filters
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $orders->links() }}
        </div>
    </div>
</div>
