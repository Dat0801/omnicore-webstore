<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
            <div class="h-48 bg-gray-200 relative">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                
                <div class="absolute top-2 right-2">
                    <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                        {{ $product->is_active_in_erp ? 'In Stock' : 'Unavailable' }}
                    </span>
                </div>
            </div>
            
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2 truncate">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                
                <div class="flex items-center justify-between mt-4">
                    <span class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm transition-colors duration-200">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500 text-lg">No products found.</p>
        </div>
    @endforelse

    <div class="col-span-full mt-6">
        {{ $products->links() }}
    </div>
</div>
