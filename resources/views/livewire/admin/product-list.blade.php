<div class="space-y-4">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900">Products</h2>
        <button
            wire:click="syncFromErp"
            wire:loading.attr="disabled"
            wire:target="syncFromErp"
            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60"
        >
            <svg
                wire:loading.remove
                wire:target="syncFromErp"
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M5 19a9 9 0 0014-7V5M19 5A9 9 0 005 12v7" />
            </svg>
            <svg
                wire:loading
                wire:target="syncFromErp"
                class="h-4 w-4 animate-spin"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3.5-3.5L12 0v4a8 8 0 00-8 8h4z"></path>
            </svg>
            <span wire:loading.remove wire:target="syncFromErp">Sync from ERP</span>
            <span wire:loading wire:target="syncFromErp">Syncing...</span>
        </button>
    </div>

    <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                <th class="px-6 py-3 border-b">Product</th>
                <th class="px-6 py-3 border-b">ERP Status</th>
                <th class="px-6 py-3 border-b">WebStore Status</th>
                <th class="px-6 py-3 border-b">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($product->image)
                                <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ $product->image }}" alt="">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 mr-3"></div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-xs text-gray-500">{{ $product->erp_product_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->is_active_in_erp ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_active_in_erp ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $product->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button wire:click="togglePublish({{ $product->id }})" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                            {{ $product->is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No products found. Run sync first.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 px-6">
        {{ $products->links() }}
    </div>
    </div>
</div>
