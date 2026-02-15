<x-layouts.admin>
    <div class="mx-auto w-full max-w-6xl px-6 py-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Product Details</h1>
                <p class="mt-1 text-sm text-slate-500">Review ERP sync status and webstore configuration for this product.</p>
            </div>
            <a
                href="{{ route('admin.products.index') }}"
                class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="m10.5 19.5-7.5-7.5 7.5-7.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M21 19.5 13.5 12 21 4.5" />
                </svg>
                <span>Back to list</span>
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-[1.2fr_0.8fr]">
            <div class="space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-start gap-4">
                        @if ($product->image)
                            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-2xl bg-slate-100">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                            </div>
                        @else
                            <div class="h-24 w-24 flex-shrink-0 rounded-2xl bg-slate-100"></div>
                        @endif
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <h2 class="text-xl font-semibold text-slate-900">{{ $product->name }}</h2>
                                @if ($product->badge)
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-blue-600">
                                        {{ $product->badge }}
                                    </span>
                                @endif
                            </div>
                            @if ($product->category)
                                <p class="mt-1 text-sm text-slate-500">Category: <span class="font-medium text-slate-700">{{ $product->category }}</span></p>
                            @endif
                            <div class="mt-3 flex flex-wrap items-center gap-3 text-sm">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-lg font-semibold text-slate-900">${{ number_format((float) $product->price, 2) }}</span>
                                    @if ($product->original_price && $product->original_price > $product->price)
                                        <span class="text-xs text-slate-400 line-through">${{ number_format((float) $product->original_price, 2) }}</span>
                                    @endif
                                </div>
                                @if ($product->rating)
                                    <div class="flex items-center gap-1 text-xs text-slate-500">
                                        <span class="text-yellow-400">★</span>
                                        <span>{{ number_format((float) $product->rating, 1) }}</span>
                                        @if ($product->reviews_count)
                                            <span>· {{ $product->reviews_count }} reviews</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($product->description)
                        <div class="mt-6 border-t border-slate-100 pt-4">
                            <h3 class="text-sm font-semibold text-slate-800">Description</h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-600">
                                {{ $product->description }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="text-sm font-semibold text-slate-800">Status</h3>
                    <dl class="mt-3 space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <dt class="text-slate-500">ERP Status</dt>
                            <dd>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $product->is_active_in_erp ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                                    {{ $product->is_active_in_erp ? 'Active in ERP' : 'Inactive in ERP' }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-slate-500">WebStore Status</dt>
                            <dd>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $product->is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                    {{ $product->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="text-sm font-semibold text-slate-800">Identifiers</h3>
                    <dl class="mt-3 space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <dt class="text-slate-500">Product ID</dt>
                            <dd class="font-mono text-slate-900">#{{ $product->id }}</dd>
                        </div>
                        @if ($product->erp_product_id)
                            <div class="flex items-center justify-between">
                                <dt class="text-slate-500">ERP Product ID</dt>
                                <dd class="font-mono text-slate-900">{{ $product->erp_product_id }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                @if ($product->is_published && $product->is_active_in_erp)
                    <a
                        href="{{ route('products.show', $product) }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800"
                    >
                        <span>View customer page</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 5h10m0 0v10m0-10L9 15" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>

