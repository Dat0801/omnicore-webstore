<div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
    @forelse($products as $product)
        <article class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200/70 transition hover:-translate-y-1 hover:shadow-lg">
            <div class="relative aspect-[4/3] bg-slate-100">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover" />
                @else
                    <div class="flex h-full items-center justify-center text-slate-300">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                <span class="absolute left-3 top-3 rounded-full bg-white/90 px-2.5 py-1 text-xs font-semibold text-slate-700">
                    {{ $product->is_active_in_erp ? 'In Stock' : 'Unavailable' }}
                </span>
            </div>

            <div class="p-4">
                <h3 class="text-base font-semibold text-slate-900">{{ $product->name }}</h3>
                <p class="mt-2 text-sm text-slate-500">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>

                <div class="mt-4 flex items-center justify-between">
                    <span class="text-lg font-semibold text-slate-900">${{ number_format($product->price, 2) }}</span>
                    <button
                        wire:click="addToCart({{ $product->id }})"
                        class="rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800"
                    >
                        Add to Cart
                    </button>
                </div>
            </div>
        </article>
    @empty
        <div class="col-span-full py-12 text-center">
            <p class="text-slate-500 text-lg">No products found.</p>
        </div>
    @endforelse

    <div class="col-span-full mt-6">
        {{ $products->links() }}
    </div>
</div>
