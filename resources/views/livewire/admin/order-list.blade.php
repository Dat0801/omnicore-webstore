<div class="space-y-4">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-2">
            <button
                wire:click="setStatus('all')"
                class="rounded-full px-3 py-1 text-xs font-semibold transition {{ $status === 'all' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                All
            </button>
            <button
                wire:click="setStatus('pending')"
                class="rounded-full px-3 py-1 text-xs font-semibold transition {{ $status === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                Pending
            </button>
            <button
                wire:click="setStatus('processing')"
                class="rounded-full px-3 py-1 text-xs font-semibold transition {{ $status === 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                Processing
            </button>
            <button
                wire:click="setStatus('delivered')"
                class="rounded-full px-3 py-1 text-xs font-semibold transition {{ $status === 'delivered' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                Delivered
            </button>
            <button
                wire:click="setStatus('cancelled')"
                class="rounded-full px-3 py-1 text-xs font-semibold transition {{ $status === 'cancelled' ? 'bg-slate-800 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                Cancelled
            </button>
        </div>

        <div class="flex items-center gap-2">
            <div class="relative">
                <input
                    type="text"
                    wire:model.debounce.300ms="search"
                    class="w-56 rounded-lg border border-slate-200 py-2 pl-9 pr-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30"
                    placeholder="Search by ID, ERP ID, or email"
                >
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 7.5 15.5a7.5 7.5 0 0 0 9.15 1.15Z" />
                    </svg>
                </span>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full text-left text-sm">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3">Customer</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Created</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-sm font-semibold text-slate-900">
                            #OMN-{{ $order->erp_order_id ?? $order->id }}
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-700">
                            <div class="font-medium">
                                {{ $order->customer_name ?? $order->user?->name ?? 'Guest' }}
                            </div>
                            <div class="text-xs text-slate-500">
                                {{ $order->customer_email ?? $order->user?->email }}
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $status = strtolower($order->status);
                                $statusClass = match ($status) {
                                    'delivered' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'processing', 'pending', 'in_transit' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'cancelled' => 'bg-slate-100 text-slate-700 border-slate-200',
                                    default => 'bg-slate-50 text-slate-700 border-slate-200',
                                };
                            @endphp
                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold {{ $statusClass }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-slate-900">
                            ${{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="px-4 py-3 text-xs text-slate-500">
                            {{ $order->created_at?->format('Y-m-d H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-sm text-slate-500">
                            No orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="border-t border-slate-100 px-4 py-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>

