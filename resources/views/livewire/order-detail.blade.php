<div class="space-y-8">
    <nav class="mb-4 flex items-center text-sm text-slate-500">
        <a href="{{ route('home') }}" class="transition hover:text-slate-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </a>
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-2 h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('dashboard') }}" class="transition hover:text-slate-900">Account</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-2 h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('orders.index') }}" class="transition hover:text-slate-900">Order History</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-2 h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-semibold text-slate-900">
            Order #OMN-{{ $order->erp_order_id ?? $order->id }}
        </span>
    </nav>

    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Order Details</h1>
            <p class="mt-1 text-sm text-slate-500">
                Placed on {{ $order->created_at->format('M d, Y') }} • Order
                #OMN-{{ $order->erp_order_id ?? $order->id }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            @php
                $statusClass = match (strtolower($order->status)) {
                    'delivered' => 'bg-green-100 text-green-700',
                    'processing', 'pending', 'in_transit' => 'bg-blue-100 text-blue-700',
                    'cancelled' => 'bg-slate-100 text-slate-600',
                    default => 'bg-slate-100 text-slate-600',
                };
                $dotClass = match (strtolower($order->status)) {
                    'delivered' => 'bg-green-500',
                    'processing', 'pending', 'in_transit' => 'bg-blue-500',
                    'cancelled' => 'bg-slate-500',
                    default => 'bg-slate-500',
                };
                $statusLabel = ucfirst($order->status);
                if (in_array(strtolower($order->status), ['processing', 'pending'])) {
                    $statusLabel = 'Processing';
                }
            @endphp

            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ $statusClass }}">
                <span class="mr-1.5 h-1.5 w-1.5 rounded-full {{ $dotClass }}"></span>
                {{ $statusLabel }}
            </span>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-900">Items</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-slate-100 bg-slate-50/50 text-xs font-bold uppercase tracking-wider text-slate-500">
                                <th class="px-4 py-3">Product</th>
                                <th class="px-4 py-3">ERP ID</th>
                                <th class="px-4 py-3 text-right">Quantity</th>
                                <th class="px-4 py-3 text-right">Price</th>
                                <th class="px-4 py-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-slate-900">
                                        {{ $item->name }}
                                    </td>
                                    <td class="px-4 py-3 text-slate-500">
                                        {{ $item->erp_product_id }}
                                    </td>
                                    <td class="px-4 py-3 text-right text-slate-700">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-4 py-3 text-right text-slate-700">
                                        ${{ number_format($item->price, 2) }}
                                    </td>
                                    <td class="px-4 py-3 text-right font-semibold text-slate-900">
                                        ${{ number_format($item->price * $item->quantity, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-900">Shipping Information</h2>
                <div class="mt-3 text-sm text-slate-600">
                    <p class="font-medium text-slate-900">
                        {{ $order->shipping_first_name ?? $order->customer_name }}
                        @if($order->shipping_last_name)
                            {{ $order->shipping_last_name }}
                        @endif
                    </p>
                    @if($order->shipping_address)
                        <p class="mt-1">
                            {{ $order->shipping_address }}
                        </p>
                    @endif
                    @if($order->shipping_city || $order->shipping_state || $order->shipping_zip)
                        <p>
                            {{ $order->shipping_city }}
                            @if($order->shipping_state)
                                , {{ $order->shipping_state }}
                            @endif
                            @if($order->shipping_zip)
                                {{ $order->shipping_zip }}
                            @endif
                        </p>
                    @endif
                    @if($order->customer_email)
                        <p class="mt-1 text-slate-500">
                            {{ $order->customer_email }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-4">
            @php
                $itemsSubtotal = $order->items->sum(function ($item) {
                    return $item->price * $item->quantity;
                });
            @endphp
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-900">Order Summary</h2>
                <dl class="mt-4 space-y-2 text-sm">
                    <div class="flex items-center justify-between">
                        <dt class="text-slate-600">Items subtotal</dt>
                        <dd class="font-medium text-slate-900">
                            ${{ number_format($itemsSubtotal, 2) }}
                        </dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-slate-600">Shipping</dt>
                        <dd class="font-medium text-slate-900">$0.00</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-slate-600">Tax</dt>
                        <dd class="font-medium text-slate-900">
                            ${{ number_format(max($order->total_amount - $itemsSubtotal, 0), 2) }}
                        </dd>
                    </div>
                </dl>
                <div class="mt-4 border-t border-slate-100 pt-4">
                    <div class="flex items-center justify-between text-sm font-bold text-slate-900">
                        <span>Total</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-700">
                <p class="font-semibold text-slate-900">Need help with this order?</p>
                <p class="mt-1">
                    Contact support with your order ID
                    <span class="font-mono">
                        #OMN-{{ $order->erp_order_id ?? $order->id }}
                    </span>
                    for faster assistance.
                </p>
            </div>
        </div>
    </div>
</div>

